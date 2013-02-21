<?php

namespace NetTeam\Bundle\DDDBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use NetTeam\Bundle\DDDBundle\DependencyInjection\DDDExtension;
use NetTeam\Bundle\DDDBundle\DependencyInjection\Compiler\DoctrineRepositoryPass;

class NetTeamDDDBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->registerExtension(new DDDExtension());

        $container->addCompilerPass(new DoctrineRepositoryPass());
    }

}
