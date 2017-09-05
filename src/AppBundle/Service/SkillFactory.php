<?php
/**
 * Created by PhpStorm.
 * User: larisa.cebuc
 * Date: 8/8/2017
 * Time: 11:02 AM
 */

namespace AppBundle\Service;
use AppBundle\Entity\Skill;
use Symfony\Component\DependencyInjection\Container;


class SkillFactory
{
   /** @var  Container  */
    private $container;


    public function createSkill(string $className, string $name, int $chance, bool $applyOnDefence, bool $applyOnAttack)
    {
        /** @var Skill $skill */
        try {
            $skill = $this->container->get($className);
        } catch (\Throwable $exception) {
            throw $exception;
        }

        $skill->setName($name)->setApplyOnAttack($applyOnAttack)->setApplyOnDefence($applyOnDefence)->setChance($chance);

        return $skill;
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }


}