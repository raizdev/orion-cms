<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Doctrine\Common\Annotations\AnnotationRegistry;
use Sunrise\Http\ServerRequest\ServerRequestFactory;
use Sunrise\Http\Router\Loader\DescriptorLoader;
use Sunrise\Http\Router\Router;
use Sunrise\Http\Router\Middleware\CallableMiddleware;
use Sunrise\Http\Message\ResponseFactory;
use Orion\Framework\Middleware\ErrorHandlingMiddleware;

use function Sunrise\Http\Router\emit;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helper.php';

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->loadEnv(__DIR__ . '/../.env');

AnnotationRegistry::registerLoader('class_exists');

$loader = new DescriptorLoader();

$loader->attach('../src/Controllers/');

$router = new Router();
$router->load($loader);

$router->addMiddleware(new ErrorHandlingMiddleware());

$request = ServerRequestFactory::fromGlobals();
$response = $router->run($request);

emit($response);

exit(0);