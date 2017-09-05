<?php

namespace AppBundle\Service;

class CharacterFactory
{
    public function createPlayer(
        string $name,
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck,
        string $type,
        string $picture
    ) {
        $player = new \AppBundle\Entity\Player();
        $player->setName($name);
        $player->setHealth($health);
        $player->setStrength($strength);
        $player->setDefence($defence);
        $player->setSpeed($speed);
        $player->setLuck($luck);
        $player->setType($type);
        $player->setPicture($picture);

        return $player;
    }
}

