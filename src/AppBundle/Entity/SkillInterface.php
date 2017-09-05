<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/7/2017
 * Time: 5:47 PM
 */

namespace AppBundle\Entity;


interface SkillInterface
{
    public function applySkill(Player $attacker, Player $defender);
}