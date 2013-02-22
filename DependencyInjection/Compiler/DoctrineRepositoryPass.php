<?php

namespace NetTeam\Bundle\DDDBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Utworzenie abstrakcyjnych serwisów obsługujących ORM i ODM.
 *
 * @author Paweł A. Wacławczyk <p.a.waclawczyk@gmail.com>
 */
class DoctrineRepositoryPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('doctrine')) {
            $definition = new Definition();
            $definition->setClass('NetTeam\DDD\Repository\DoctrineRepository')
                    ->addArgument($container->getDefinition('doctrine'))
                    ->setAbstract(true);
            $container->setDefinition('nt_ddd.repository.orm', $definition);
        }

        if ($container->hasDefinition('doctrine_mongodb')) {
            $definition = new Definition();
            $definition->setClass('NetTeam\DDD\Repository\DoctrineRepository')
                    ->addArgument($container->getDefinition('doctrine_mongodb'))
                    ->setAbstract(true);
            $container->setDefinition('nt_ddd.repository.odm', $definition);
        }
    }

}
