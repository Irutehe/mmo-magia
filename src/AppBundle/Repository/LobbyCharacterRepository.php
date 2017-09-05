<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/17/2017
 * Time: 2:09 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Lobby;
use Doctrine\ORM\EntityRepository;

class LobbyCharacterRepository extends EntityRepository
{
    public function getUnavailableCharacters(Lobby $lobby)
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('c')
            ->from('AppBundle:Characters', 'c')
            ->join('AppBundle:LobbyCharacter','lc', 'WITH', 'c.id = lc.character')
            ->where("lc.lobby = :lobby")
            ->setParameter("lobby", $lobby);

        return $qb->getQuery()->getResult();
    }
}