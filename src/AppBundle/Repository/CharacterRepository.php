<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/17/2017
 * Time: 2:22 PM
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CharacterRepository extends EntityRepository
{
    public function getAvailableCharacters(array $unavailableCharacters): array
    {
        return $this->createQueryBuilder("c")
            ->where("c.id NOT IN (:unavailableCharacters)")
            ->setParameter("unavailableCharacters", $unavailableCharacters)
            ->getQuery()
            ->getResult();
    }
}