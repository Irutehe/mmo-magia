<?php

namespace AppBundle\Service;

use AppBundle\Entity\LobbyCharacter;

class CharacterFactory
{
    public function createPlayer(LobbyCharacter $lobbyCharacter) {

        $player = new \AppBundle\Entity\Player();
        $player->setLevel($lobbyCharacter->getUserIp()->getExperience());
        $player->setName($lobbyCharacter->getNickname() ?: $lobbyCharacter->getCharacter()->getName());
        $player->setHealth($lobbyCharacter->getCharacter()->getHealth());
        $player->setStrength($lobbyCharacter->getCharacter()->getStrength());
        $player->setDefence($lobbyCharacter->getCharacter()->getDefence());
        $player->setSpeed($lobbyCharacter->getCharacter()->getSpeed());
        $player->setLuck($lobbyCharacter->getCharacter()->getLuck());
        $player->setType($lobbyCharacter->getCharacter()->getType());
        $player->setPicture($lobbyCharacter->getCharacter()->getPicture());
        $player->setXp($lobbyCharacter->getUserIp()->getExperience());
        $player->setUserIp($lobbyCharacter->getUserIp()->getUserIp());
        $player->setLobbyCharacter($lobbyCharacter);

        return $player;
    }
}

