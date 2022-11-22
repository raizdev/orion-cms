<?php
namespace KPN\App\Controllers;

use KPN\App\Middlewares\ClaimMiddleware;
use KPN\Core\Controller\BaseController;
use KPN\App\Models\AAMigrations;

use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use MinasORM\Database;

class Api extends BaseController {
  
    #[Mapping\Route
    (
        name: '/aa-migration-by-dslam', 
        path: '/api/migrations/accessarea/dslam/{dslam}', 
        middlewares: [
            ClaimMiddleware::class
        ]
    )]
    public function byDslam(Request $request): Response
    {
        $migration = AAMigrations::where('dslam', $request->getAttribute('dslam'))->get();

        if(empty($migration)) {
            return $this->respond(
                (new ResponseFactory)->createResponse(200),
                response()->setData("DSLAM not found")
            );
        }


        $cliObject = [
            "cliTable" => true,
            "tableHead" => [
                'dslam',
                'old_aa',
                'new_aa',
                'plandate',
                'mig_type'
            ],
            "content" => $migration,
            "except" => [
                'id',
                'batchnr'
            ]
        ];

        return $this->respond(
            (new ResponseFactory)->createResponse(200),
            response()->setData($cliObject)
        );
    }

    #[Mapping\Route
    (
        name: '/help', 
        path: '/api/help', 
        middlewares: [
            ClaimMiddleware::class
        ]
    )]
    public function help(Request $request): Response
    {
        $message = "This feature will be implemented later!";

        return $this->respond(
            (new ResponseFactory)->createResponse(200),
            response()->setData($message)
        );
    }
}
?>