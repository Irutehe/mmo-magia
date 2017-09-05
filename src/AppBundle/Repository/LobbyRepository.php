<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/21/2017
 * Time: 4:32 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Lobby;
use Doctrine\ORM\EntityRepository;


class LobbyRepository extends EntityRepository
{
    public function getBattleLogs($ip)
    {
        return $this->createQueryBuilder('l')
            ->join('AppBundle:LobbyCharacter', 'lc', 'WITH', 'l = lc.lobby')
            ->where('lc.userIp = :ip')
            ->andWhere('l.status = :finished')
            ->setParameter('ip', $ip)
            ->setParameter('finished', Lobby::STATUS_FINISHED)
            ->getQuery()
            ->getResult();
    }
}