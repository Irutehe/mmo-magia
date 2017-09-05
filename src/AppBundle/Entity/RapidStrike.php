<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/7/2017
 * Time: 5:50 PM
 */

namespace AppBundle\Entity;


class RapidStrike extends Skill implements SkillInterface
{
    public function applySkill(Player $attacker, Player $defender)
    {
        return 2;
    }
}