<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/4/2017
 * Time: 4:28 PM
 */

use AppBundle\Service\Battle;
use AppBundle\Entity\Player;

class BattleTest extends \PHPUnit\Framework\TestCase
{
    public function getFirstStrikeProvider()
    {
        $player1 = new Player();
        $player1->setSpeed(100)->setLuck(43);
        $player2 = new Player();
        $player2->setSpeed(90)->setLuck(36);
        $player3 = new Player();
        $player3->setSpeed(90)->setLuck(30);

        return [
            [
                'players'        => [$player1, $player2],
                'expectedResult' => [$player1, $player2]
            ],
            [
                'players'        => [$player1, $player2, $player3],
                'expectedResult' => [$player1, $player2, $player3]
            ]
        ];
    }

    /** @dataProvider getFirstStrikeProvider */
    public function testFirstStrike($players, $expectedResult)
    {
        $battle = new Battle();

        $result = $battle->sortPlayers($players);

        static::assertEquals($expectedResult, $result);
    }


    public function damageProvider()
    {


        $attacker = new Player();
        $attacker->setHealth(100)->setStrength(200);
        $defender = new Player();
        $defender->setHealth(150)->setDefence(150);
//        $player3= new Player();
//        $player3->setHealth(130)->setStrength(180);


        return [

            [
                'attacker'       => $attacker,
                'defender'       => $defender,
                'expectedResult' => 100
            ]
        ];
    }

    /** @dataProvider damageProvider */
    public function testDamage($attacker, $defender, $expectedResult)
    {
        $battleService = $this->getMockBuilder(Battle::class)->disableOriginalConstructor()->getMock();
        $battleService->expects($this->any())->method('getDamage')->willReturn(50);
        $skillRS = new \AppBundle\Entity\RapidStrike();
        $skillRS->setChance(100)->setApplyOnAttack(true)->setBattle($battleService);
        $skillMS = new \AppBundle\Entity\MagicShield();
        $skillMS->setChance(100)->setApplyOnDefence(true)->setBattle($battleService);
        $attackerNoSkill = clone ($attacker);
        $defenderNoSkill = clone ($defender);
        $attacker->setSkills([$skillRS]);
        $defender->setSkills([$skillMS]);
        $battle = new Battle();
        $battle->fight($attacker, $defender);
        static::assertEquals($expectedResult, $defender->getHealth());
        $attackerNoSkill->setSkills([]);
        $defenderNoSkill->setSkills([]);
        $battle->fight($attackerNoSkill, $defenderNoSkill);
        static::assertEquals($expectedResult, $defenderNoSkill->getHealth());
    }
}


