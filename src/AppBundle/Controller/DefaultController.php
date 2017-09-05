<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Characters;
use AppBundle\Entity\Lobby;
use AppBundle\Entity\LobbyCharacter;
use AppBundle\Entity\Player;
use AppBundle\Entity\Skill;
use AppBundle\Service\CharacterFactory;
use AppBundle\Service\SkillFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/battle", name="battle")
     */
    public function battleAction()
    {
        $lobbyService = $this->get("lobby_service");

        $lobby = $lobbyService->getPendingLobby();

        if (!$lobby) {
            throw new \Exception("Nu exista niciun lobby cu status pending");
        }

        $lobbyCharacters = $lobby->getLobbyCharacters();

        if (!$lobbyCharacters) {
            throw new \Exception("Nu exista caractere");
        }

        /** @var CharacterFactory $characterFactory */
        $characterFactory = $this->get('character_factory');
        $players          = [];

        /** @var LobbyCharacter $lobbyCharacter */
        foreach ($lobbyCharacters as $lobbyCharacter) {

            $player = $characterFactory->createPlayer(
                $lobbyCharacter->getNickname() ? :  $lobbyCharacter->getCharacter()->getName(),
                $lobbyCharacter->getCharacter()->getHealth(),
                $lobbyCharacter->getCharacter()->getStrength(),
                $lobbyCharacter->getCharacter()->getDefence(),
                $lobbyCharacter->getCharacter()->getSpeed(),
                $lobbyCharacter->getCharacter()->getLuck(),
                $lobbyCharacter->getCharacter()->getType(),
                $lobbyCharacter->getCharacter()->getPicture()
            );
            /** @var SkillFactory $skillFactory */
            $skillFactory = $this->get('skill_factory');
            $skills = [];
            /** @var Skill $skillStat */
            foreach ($lobbyCharacter->getCharacter()->getSkills() as $skillStat) {
                $skills[] = $skillFactory->createSkill(
                    $skillStat->getClassName(),
                    $skillStat->getName(),
                    $skillStat->getChance(),
                    $skillStat->getApplyOnDefence(),
                    $skillStat->getApplyOnAttack()
                );
            }
            $player->setSkills($skills);

            $players[] = $player;
        }

        $battle               = $this->get('battle');
        $strikeOrder          = $battle->sortPlayers($players);
        $groupedPlayersByType = $battle->groupPlayersByType($players);


        $winningTeam = null;
        $round       = 0;
        do {
            $round++;
            $battle->addToBattleLog("Round $round!");

            /** @var Player $player */
            foreach ($strikeOrder as $player) {
                if ($player->getHealth() <= 0) {
                    continue;
                }
                $enemies = $battle->getEnemy($players, $player->getType());
                if (count($enemies) === 0) {
                    $winningTeam = $player->getType();
                    break;
                }
                $battle->fight($player, $enemies[array_rand($enemies)]);
            }
        } while (!$winningTeam);

        $battle->addToBattleLog('Winning Team: ' . $winningTeam);
        $lobby->setBattleLog(json_encode($battle->getBattleLog()))->setStatus(Lobby::STATUS_FINISHED);

        $lobbyService->saveLobby($lobby);

        return $this->render(
            'default/index.html.twig',
            [
                'strikeOrder'          => $strikeOrder,
                'groupedPlayersByType' => $groupedPlayersByType,
                'winningTeam'          => $winningTeam,
                'battleLog'            => $battle->getBattleLog()
            ]
        );

    }

    /**
     * @Route("/", name="lobby")
     */
    public function lobbyAction(Request $request)
    {
        $userBattles  = [];
        $ip           = $request->getClientIp();
        $lobbyService = $this->get('lobby_service');
        $lobby        = $lobbyService->getPendingLobby();
        if (!$lobby) {
            $lobby = $lobbyService->addPendingLobby();
        }
        $lobbyCharacter = $lobbyService->getLobbyCharacterForIp($lobby, $ip);

        if (!$lobbyCharacter) {
            $lobbyCharacter = $lobbyService->addNewCharacterToLobby($lobby, $ip);
            if (!$lobbyCharacter) {
                return $this->battleAction();
            }
        }

        if(!$lobbyCharacter->getNickname())
        {
            return $this->redirectToRoute('addNickname');
        }


        $lobbies = $lobbyService->getUserLobbies($ip);

        /** @var Lobby $userLobby */
        foreach ($lobbies as $userLobby) {
            $myCharacter   = $lobbyService->getMyCharacter($userLobby->getLobbyCharacters()->toArray(), $ip);
            $battleLog     = str_replace($myCharacter->getType(), $myCharacter->getType() . '(You)', $userLobby->getBattleLog());
            $userBattles[] = json_decode($battleLog);
        }

        return $this->render(
            'default/lobby.html.twig',
                             [
                                 'lobby' => $lobby,
                                 'battles' => $userBattles,
                                 'endTime' => $lobby->getCreated()->add(new \DateInterval('PT3H'))->format("Y-m-d h:i:s")
                             ]
        );
    }

    /**
     * @Route("/nickname/add", name="addNickname")
     */
    public function addNicknameAction(Request $request)
    {
        $ip           = $request->getClientIp();
        $lobbyService = $this->get('lobby_service');
        $lobby        = $lobbyService->getPendingLobby();
        if (!$lobby) {
            $lobby = $lobbyService->addPendingLobby();
        }
        $lobbyCharacter = $lobbyService->getLobbyCharacterForIp($lobby, $ip);

        $form = $this->createFormBuilder($lobbyCharacter)
            ->add('nickname', TextType::class)
            ->add('save', SubmitType::class, ['label'=>'Save Nickname'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             $em = $this->getDoctrine()->getManager();
             $em->persist($lobbyCharacter);
             $em->flush();

            return $this->redirectToRoute('lobby');
        }

        return $this->render('default/addNickname.html.twig', ['form'=>$form->createView()]);
    }

}

