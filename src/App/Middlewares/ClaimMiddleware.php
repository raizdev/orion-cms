<?php
namespace KPN\App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sunrise\Http\Router\RouteCollection;
use Sunrise\Http\Router\Router;
use Sunrise\Http\Message\ResponseFactory;

class ClaimMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $authorization = explode(' ', $request->getHeaderLine('Authorization'));
        $type          = $authorization[0] ?? '';
        $credentials   = $authorization[1] ?? '';
        $secret        = $_ENV['TOKEN_SECRET'];

        if(empty($credentials) || $credentials !== $secret) {
            return (new ResponseFactory)->createJsonResponse(200, 'No autorization token found or invalid');
        }

        $response = $handler->handle($request);
        return $response;
    }
}