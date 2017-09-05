<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/16/2017
 * Time: 4:41 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="lobby")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LobbyRepository")
 */
class Lobby
{
    const STATUS_PENDING = 'pending';
    const STATUS_FINISHED = 'finished';

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created")
     */
    private $created;

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     *
     * @return Lobby
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }


    /**
     * One Lobby has Many characters.
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="LobbyCharacter", mappedBy="lobby")
     */
    private $lobbyCharacters;

    public function __construct()
    {
        $this->lobbyCharacters = new ArrayCollection();
    }


    public function getLobbyCharacters(): PersistentCollection
    {
        return $this->lobbyCharacters;
    }

    /**
     * @param ArrayCollection $lobbyCharacters
     *
     * @return Lobby
     */
    public function setLobbyCharacters(ArrayCollection $lobbyCharacters): Lobby
    {
        $this->lobbyCharacters = $lobbyCharacters;

        return $this;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="battle_log") */
    private $battleLog;

    /**
     * @return mixed
     */
    public function getBattleLog()
    {
        return $this->battleLog;
    }

    /**
     * @param mixed $battleLog
     *
     * @return Lobby
     */
    public function setBattleLog($battleLog)
    {
        $this->battleLog = $battleLog;

        return $this;
    }

    /** @ORM\Column(type="string", name="status") */
    private $status;


    /** @ORM\Column(type="string", name="arena_type") */
    private $arenaType;


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
     * @return Lobby
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return Lobby
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArenaType()
    {
        return $this->arenaType;
    }

    /**
     * @param mixed $arenaType
     *
     * @return Lobby
     */
    public function setArenaType($arenaType)
    {
        $this->arenaType = $arenaType;

        return $this;
    }

    public function addToBattleLog(string $message)
    {
        $this->battleLog[] = $message;

    }



}

