<?php declare(strict_types=1);

use function DI\autowire;
use function DI\create;
use function DI\env;
use function DI\string;

use Orion\Framework\Middleware\ErrorHandlingMiddleware;
use Odan\Session\SessionInterface;
use Odan\Session\PhpSession;

return [
    'middlewares' => [
        autowire(ErrorHandlingMiddleware::class),
    ],
];