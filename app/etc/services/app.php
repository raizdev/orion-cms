<?php declare(strict_types=1);

use function DI\autowire;

use Orion\Framework\Middleware\ErrorHandlingMiddleware;
use Orion\Framework\Model\Twig;

return [
    'middlewares' => [
        autowire(ErrorHandlingMiddleware::class)
    ]
];