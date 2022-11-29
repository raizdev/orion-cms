<?php
namespace Orion\Controllers;

use Orion\Framework\Controller\BaseController;
use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\Annotation\Prefix;
use PHLAK\Config\Interfaces\ConfigInterface;

#[Prefix('/api')]
class Api extends BaseController {
  
    public function __construct(
        private ConfigInterface $config
    ) {}

    #[Mapping\Route('/config', path: '/config')]
    public function index(Request $request) {

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