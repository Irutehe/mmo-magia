<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 9/5/2017
 * Time: 12:11 PM
 */

namespace AppBundle\Entity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users_experience")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersExperienceRepository")
 */
class UsersExperience
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * UsersExperience have One UserIp.
     * @ORM\OneToOne(targetEntity="LobbyCharacter")
     * @ORM\JoinColumn(name="user_ip", referencedColumnName="user_ip")
     */
    private $userIp;

    /** @ORM\Column(type="integer", name="experience") */
    private $experience;

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
     * @return UsersExperience
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * @param mixed $userIp
     *
     * @return UsersExperience
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     *
     * @return UsersExperience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }



}