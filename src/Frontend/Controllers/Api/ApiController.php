<?php
namespace Orion\Controllers;

use Orion\Framework\Controller\BaseController;
use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\Annotation\Prefix;
use Sunrise\Http\Router\Annotation\Route;
use PHLAK\Config\Interfaces\ConfigInterface;

/**
 * Class ApiController
 *
 * @package Orion\Frontend\Controllers
 */

#[Prefix('/api')]
class ApiController extends BaseController {
  
    /**
     * ApiController constructor.
     * @param ConfigInterface $config
     */
    public function __construct(
        private ConfigInterface $config
    ) {}

    /**
     *
     * @param Request $request
     * @return Response
     */

    #[Route(
        name: 'config',
        path: '/config',
        methods: ['GET'],
    )]

    public function config(Request $request) {

        $config = array_merge(
            $this->config->get('website_settings'), 
            $this->config->get('hotel_settings')
        );
        
        unset($config["recaptcha"]["secretkey"]);

        return $this->respond(
            (new ResponseFactory)->createResponse(200),
            response()->setData($config)
        );
    }
}
?>