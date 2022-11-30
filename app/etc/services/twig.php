<?php declare(strict_types=1);

use Orion\Framework\Service\TwigService;
use Orion\Framework\Provider\TwigServiceProvider;

return [
    TwigService::class => DI\factory([TwigServiceProvider::class, 'register'])
];