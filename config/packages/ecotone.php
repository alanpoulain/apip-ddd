<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    if ('test' === $containerConfigurator->env()) {
        $containerConfigurator->extension('ecotone', [
            'namespaces' => ['App\Tests'],
        ]);
    }
};
