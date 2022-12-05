<?php declare(strict_types=1);

use function DI\autowire;
use function DI\create;

use Orion\Framework\Middleware\ErrorHandlingMiddleware;
use Odan\Session\Middleware\SessionMiddleware;

return [
    'middlewares' => [
        autowire(ErrorHandlingMiddleware::class),
        autowire(SessionMiddleware::class)
    ]
];