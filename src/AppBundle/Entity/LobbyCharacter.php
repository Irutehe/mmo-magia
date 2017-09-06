<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="lobby_character")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LobbyCharacterRepository")
 */
class LobbyCharacter
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * LobbyCharacter have one Lobby
     * @ORM\ManyToOne(targetEntity="Lobby", inversedBy="lobbyCharacters")
     * @ORM\JoinColumn(name="lobby_id", referencedColumnName="id")
     */
    private $lobby;
    /**
     * LobbyCharacter have One UsersExperience.
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\UsersExperience")
     * @ORM\JoinColumn(name="user_ip", referencedColumnName="user_ip")
     */
    private $userIp;

    /** @ORM\Column(type="string", name="nickname") */
    private $nickname;

    /**
     * LobbyCharacter have One Character.
     * @ORM\OneToOne(targetEntity="Characters")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id")
     */
    private $character;


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
     * @return LobbyCharacter
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLobby()
    {
        return $this->lobby;
    }

    /**
     * @param mixed $lobby
     *
     * @return LobbyCharacter
     */
    public function setLobby($lobby)
    {
        $this->lobby = $lobby;

        return $this;
    }

    /**
     * @return UsersExperience
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * @param mixed $userIp
     *
     * @return LobbyCharacter
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     *
     * @return LobbyCharacter
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * @param mixed $character
     *
     * @return LobbyCharacter
     */
    public function setCharacter($character)
    {
        $this->character = $character;

        return $this;
    }


}
