<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 9/5/2017
 * Time: 12:11 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users_experience")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersExperienceRepository")
 */
class UsersExperience
{


    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $userIp;

    /** @ORM\Column(type="integer", name="experience") */
    private $experience;

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