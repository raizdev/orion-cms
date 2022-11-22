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

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helper.php';

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->loadEnv(__DIR__ . '/../.env');

AnnotationRegistry::registerLoader('class_exists');

$loader = new DescriptorLoader();

$loader->attach('../src/App/Controllers/');

$router = new Router();
$router->addMiddleware(new CallableMiddleware(function ($request, $handler) {
    try {
        return $handler->handle($request);
    } catch (MethodNotAllowedException $e) {
        return (new ResponseFactory)->createJsonResponse(501, 'route not found');
    } catch (RouteNotFoundException $e) {
        return (new ResponseFactory)->createJsonResponse(404, 'route not found');
    } catch (Throwable $e) {
        return (new ResponseFactory)->createJsonResponse(500, 'route not found');
    }
}));
$router->load($loader);

$request = ServerRequestFactory::fromGlobals();
$response = $router->run($request);
echo $response->getBody();
