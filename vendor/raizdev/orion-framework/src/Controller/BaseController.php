<?php
namespace Orion\Framework\Controller;

use Orion\Framework\Handler\TwigViewResponseHandler;
use Orion\Framework\Interfaces\CustomResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Orion\Framework\Model\Validation;

abstract class BaseController  {

    protected function twig(string $page) 
    {
        return (new TwigViewResponseHandler)->render($page);
    }

    protected function validate(mixed $data, array $rules) 
    {
        return (new Validation)->validate($data, $rules); 
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