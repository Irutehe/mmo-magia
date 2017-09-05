<?php

namespace AppBundle\Entity;

/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/2/2017
 * Time: 11:08 AM
 */
class Player
{
    private $name;
    private $health;
    private $strength;
    private $defence;
    private $speed;
    private $luck;
    private $type;
    private $skills;
    private $picture;
    private $level;
    private $xp;


    const HEROTYPE = 'HEROES';
    const BEASTTYPE = 'BEASTS';

    /**
     * @return mixed
     */
    public function getXp()
{
    return $this->xp;
}

    /**
     * @param mixed $xp
     *
     * @return Player
     */
    public function setXp($xp)
    {
        $this->xp = $xp;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
       return $this->level;
    }

    /**
     * @param int $xp
     *
     * @return Player
     */
    public function setLevel(int $xp)
    {
        $nextLevel = -1;
        $level = 0;

        while($nextLevel < $xp){
            $nextLevel += pow(($level+1),3)+30*pow(($level+1),2)+30*($level+1)-50;
            $level++;
        }
        $this->level = $level;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return Player
     */
    public function setType($type): Player
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     *
     * @return Player
     */
    public function setPicture($picture): Player
    {
        $this->picture = $picture;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return Player
     */

    public function setName($name): Player
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param array $skills
     *
     * @return Player
     */
    public function setSkills($skills): Player
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param mixed $health
     *
     * @return Player
     */
    public function setHealth($health): Player
    {
        $this->health = $health;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     *
     * @return Player
     */
    public function setStrength($strength): Player
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @param mixed $defence
     *
     * @return Player
     */
    public function setDefence($defence): Player
    {
        $this->defence = $defence;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     *
     * @return Player
     */
    public function setSpeed($speed): Player
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     *
     * @return Player
     */
    public function setLuck($luck): Player
    {
        $this->luck = $luck;

        return $this;
    }


}

