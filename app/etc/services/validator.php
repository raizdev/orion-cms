<?php declare(strict_types=1);

use Orion\Framework\Service\ValidatorService;
use Orion\Framework\Service\ContainerService;

use function DI\factory;

return [
    ValidatorService::class => factory(function ($container) {
        $config = $container->get(ConfigInterface::class);
        return new Validator($config->get('validation'));
    })
];