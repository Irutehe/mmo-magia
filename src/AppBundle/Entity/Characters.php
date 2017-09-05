<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/16/2017
 * Time: 4:44 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="characters")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharacterRepository")
 */

class Characters
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name") */
    private $name;


    /** @ORM\Column(name="health", type="integer") */
    private $health;


    /** @ORM\Column(name="strength", type="integer") */
    private $strength;


    /** @ORM\Column(name="defence", type="integer") */
    private $defence;


    /** @ORM\Column(name="speed", type="integer") */
    private $speed;


    /** @ORM\Column(name="luck", type="integer") */
    private $luck;


    /** @ORM\Column(type="string", name="`type`") */
    private $type;


    /** @ORM\Column(type="string", name="picture") */
    private $picture;


    /**
     * Many Characters have Many Skills.
     * @ORM\ManyToMany(targetEntity="Skill")
     * @ORM\JoinTable(name="character_skills",
     *      joinColumns={@ORM\JoinColumn(name="character_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="skill_id", referencedColumnName="id")}
     *      )
     */
    private $skills;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Characters
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * @param mixed $name
     *
     * @return Characters
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @return Characters
     */
    public function setHealth($health)
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
     * @return Characters
     */
    public function setStrength($strength)
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
     * @return Characters
     */
    public function setDefence($defence)
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
     * @return Characters
     */
    public function setSpeed($speed)
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
     * @return Characters
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;

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
     * @return Characters
     */
    public function setType($type)
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
     * @return Characters
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

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
     * @param mixed $skills
     *
     * @return Characters
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }


}
