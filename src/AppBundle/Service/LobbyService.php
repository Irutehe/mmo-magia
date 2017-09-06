<?php

//TODO daca toate caracterele sunt asignate, pentru un lobby in status pending, atunci declansam lupta.

namespace AppBundle\Service;


use AppBundle\Entity\Characters;
use AppBundle\Entity\Lobby;
use AppBundle\Entity\LobbyCharacter;
use AppBundle\Entity\Player;
use AppBundle\Entity\UsersExperience;
use Doctrine\ORM\EntityManager;

class LobbyService
{
    /** @var  EntityManager */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getPendingLobby()
    {
        $repo = $this->entityManager->getRepository(Lobby::class);

        return $repo->findOneBy(['status' => Lobby::STATUS_PENDING]);

    }

    public function addPendingLobby()
    {
        $lobby = new Lobby();
        $lobby->setStatus(Lobby::STATUS_PENDING)->setCreated(new \DateTime());
        $this->entityManager->persist($lobby);
        $this->entityManager->flush();

        return $lobby;
    }

    public function getLobbyCharacterForIp(Lobby $lobby, UsersExperience $usersExperience)
    {
        $repo = $this->entityManager->getRepository(LobbyCharacter::class);

        return $repo->findOneBy(['userIp' => $usersExperience, 'lobby' => $lobby]);
    }


    public function addNewCharacterToLobby(Lobby $lobby, UsersExperience $userExperience)
    {
        $lobbyCharacter = new LobbyCharacter();

        $unavailableCharacters = $this->getLobbyCharacters($lobby);
        $availableCharacters   = $this->getAvailableCharacters($unavailableCharacters);
        if (empty($availableCharacters)) {
            return null;
        }

        $character = $availableCharacters[array_rand($availableCharacters)];
        $lobbyCharacter->setCharacter($character)->setUserIp($userExperience)->setLobby($lobby);
        $this->entityManager->persist($lobbyCharacter);
        $this->entityManager->flush();

        return $lobbyCharacter;
    }

    private function getAvailableCharacters(array $unavailableCharacters)
    {
        if (!empty($unavailableCharacters)) {

            return $this->entityManager->getRepository(Characters::class)->getAvailableCharacters($unavailableCharacters);
        }

        return $this->entityManager->getRepository(Characters::class)->findAll();
    }

    public function getLobbyCharacters(Lobby $lobby)
    {
        return $this->entityManager->getRepository(LobbyCharacter::class)->getUnavailableCharacters($lobby);
    }

    public function saveLobby(Lobby $lobby)
    {
        $lobby->setStatus(Lobby::STATUS_FINISHED)->setCreated(new \DateTime());

        $this->entityManager->persist($lobby);
        $this->entityManager->flush();

        return $lobby;
    }

    public function getUserLobbies(string $ip): array
    {
        return $this->entityManager->getRepository(Lobby::class)->getBattleLogs($ip);
    }

    public function getMyCharacter(array $lobbyCharacterList, string $ip)
    {
        /** @var LobbyCharacter $lobbyCharacter */
        foreach ($lobbyCharacterList as $lobbyCharacter) {
            if ($lobbyCharacter->getUserIp()->getUserIp() === $ip) {
                return $lobbyCharacter->getCharacter();
            }
        }

        return null;
    }

    public function saveGainedXpToUsersExperience(array $players)
    {
        $repo = $this->entityManager->getRepository(UsersExperience::class);
        /** @var Player $player */
        foreach ($players as $player)
        {
            $usersExperience = $repo->findOneBy(['userIp'=>$player->getUserIp()]);
            $usersExperience->setExperience($player->getXp());
            $this->entityManager->persist($usersExperience);
        }
        $this->entityManager->flush();
    }

    public function getUserExperience(string $ip)
    {
        $userExperience = $this->entityManager->getRepository(UsersExperience::class)->findOneBy(['userIp' => $ip]);

        if(!$userExperience){
            $userExperience = new UsersExperience();
            $userExperience->setUserIp($ip)->setExperience(0);
            $this->entityManager->persist($userExperience);
            $this->entityManager->flush();

        }
        return $userExperience;
    }

}
