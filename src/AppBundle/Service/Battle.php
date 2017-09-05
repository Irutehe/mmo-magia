<?php

namespace AppBundle\Service;

use AppBundle\Entity\Player;
use AppBundle\Entity\Skill;

/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/3/2017
 * Time: 2:42 PM
 */
class Battle
{
    private $battleLog;

    public function addToBattleLog(string $message)
    {
        $this->battleLog[] = $message;

    }

    public function getBattleLog()
    {
        return $this->battleLog;
    }

    public function sortPlayers(array $players): array
    {

        $speedArray = $this->sortBySpeed($players);
        $result     = $this->sortByLuck($players, $speedArray);

        return $result;
    }


    private function sortBySpeed(array $players): array
    {
        foreach ($players as $index => $player) {
            $speedArray[$player->getSpeed()][$index] = $player->getLuck();
        }
        krsort($speedArray);

        return $speedArray;
    }


    private function sortByLuck(array $players, array $speedArray): array
    {
        $result = [];

        foreach ($speedArray as $speed => $playerIndex) {
            if (count($playerIndex) > 1) {
                $playerIndex = array_flip($playerIndex);
                krsort($playerIndex);
                foreach ($playerIndex as $luck => $index) {
                    $result[] = $players[$index];
                }
            } else {
                foreach ($playerIndex as $index => $luck) {
                    $result[] = $players[$index];
                }
            }
        }

        return $result;
    }

    public function groupPlayersByType(array $players): array
    {
        $result = [];
        /** @var Player $player */
        foreach ($players as $player) {
            $result[$player->getType()][] = $player;
        }

        return $result;
    }

    public function getEnemy(array $players, string $friendlyType): array
    {
        $enemies = [];
        /** @var Player $player */
        foreach ($players as $player) {
            if ($player->getType() !== $friendlyType && $player->getHealth() > 0) {
                $enemies[] = $player;
            }
        }

        return $enemies;
    }

    public function fight(Player $attacker, Player $defender)
    {
        $attackMultiplier  = $this->applyAttackSkills($attacker, $defender);
        $defenceMultiplier = $this->applyDefenceSkills($attacker, $defender);

        $damage      = $this->getDamage($attacker, $defender);
        $finalDamage = $attackMultiplier * $defenceMultiplier * $damage;

        $this->addToBattleLog("{$attacker->getName()} strikes {$defender->getName()} with $finalDamage");

        if ($defender->getHealth() - $finalDamage <= 0) {
            $this->addToBattleLog("{$defender->getName()} died.");
        }
        $defender->setHealth($defender->getHealth() - $finalDamage);

    }

    private function hasChance($playerLuck)
    {
        return $playerLuck >= rand(1, 100);
    }

    /**
     * @param Player $attacker
     * @param Player $defender
     *
     * @return mixed
     */
    public function getDamage(Player $attacker, Player $defender)
    {
        $criticalDamage = 1;

        if($this->hasChance($attacker->getLuck()))
        {
            $criticalDamage = 1.5;
            $this->addToBattleLog('Critical Strike!');
        }
        $damage = $attacker->getStrength() - $defender->getDefence();

        return $damage*$criticalDamage;
    }


    /**
     * @param Player $attacker
     * @param Player $defender
     *
     * @return double
     */
    private function applyAttackSkills(Player $attacker, Player $defender)
    {
        $multiplier = 1;
        /** @var Skill $skill */
        foreach ($attacker->getSkills() as $skill) {
            if ($skill->getApplyOnAttack() && $this->hasChance($skill->getChance())) {
                $multiplier *= $skill->applySkill($attacker, $defender);
                $this->addToBattleLog("{$attacker->getName()} uses {$skill->getName()} on {$defender->getName()}");
            }
        }

        return $multiplier;
    }

    /**
     * @param Player $attacker
     * @param Player $defender
     *
     * @return double
     */
    private function applyDefenceSkills(Player $attacker, Player $defender)
    {
        $multiplier = 1;
        /** @var Skill $skill */
        foreach ($defender->getSkills() as $skill) {
            if ($skill->getApplyOnDefence() && $this->hasChance($skill->getChance())) {
                $multiplier *= $skill->applySkill($attacker, $defender);
                $this->addToBattleLog("{$defender->getName()} uses {$skill->getName()}");
            }
        }

        return $multiplier;
    }

    public function getLevel(Player $attacker, Player $defender)
    {
        if($attacker->getXp() > $defender->getXp()) {

        }
    }
}

