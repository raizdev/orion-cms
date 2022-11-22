<?php
namespace KPN\Core\Controller;

use KPN\Core\Handler\TwigViewResponseHandler;
use KPN\Core\Interfaces\CustomResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;

abstract class BaseController  {
  
    protected function twig(string $page) 
    {
        return (new TwigViewResponseHandler)->render($page);
    }

    protected function respond(Response $response, CustomResponseInterface $customResponse): Response
    {
        $response->getBody()->write($customResponse->getJson());

        return $response
            ->withStatus(
                $customResponse
                    ->getCode()
            )
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}
?>