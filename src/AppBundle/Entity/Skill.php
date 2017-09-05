<?php

namespace AppBundle\Entity;

//use AppBundle\Service\Battle;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="skills")
 */
class Skill implements SkillInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /** @ORM\Column(type="string", name="name") */
    private $name;
    /** @ORM\Column(type="integer", name="chance") */
    private $chance;
    /** @ORM\Column(type="integer", name="apply_on_defence") */
    private $applyOnDefence;
    /** @ORM\Column(type="integer", name="apply_on_attack") */
    private $applyOnAttack;
    /** @ORM\Column(type="string", name="class_name")  */
    private $className;

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     *
     * @return Skill
     */
    public function setClassName($className)
    {
        $this->className = $className;

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
     * @return Skill
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChance()
    {
        return $this->chance;
    }

    /**
     * @param mixed $chance
     *
     * @return Skill
     */
    public function setChance($chance)
    {
        $this->chance = $chance;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplyOnDefence()
    {
        return $this->applyOnDefence;
    }

    /**
     * @param mixed $applyOnDefence
     *
     * @return Skill
     */
    public function setApplyOnDefence($applyOnDefence)
    {
        $this->applyOnDefence = $applyOnDefence;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApplyOnAttack()
    {
        return $this->applyOnAttack;
    }

    /**
     * @param mixed $applyOnAttack
     *
     * @return Skill
     */
    public function setApplyOnAttack($applyOnAttack)
    {
        $this->applyOnAttack = $applyOnAttack;

        return $this;
    }



//


    public function applySkill(Player $attacker, Player $defender)
    {
        // TODO: Implement applySkill() method.
    }
}


