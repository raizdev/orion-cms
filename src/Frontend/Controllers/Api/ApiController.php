<?php
namespace Orion\Controllers;

use Orion\Framework\Controller\BaseController;
use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\Annotation\Prefix;

#[Prefix('/api')]
class Api extends BaseController {
  
    #[Mapping\Route('/config', path: '/config')]
    public function index(Request $request) {

        $config = array_merge(config('website_settings'), config('hotel_settings'));
        unset($config["recaptcha"]["secretkey"]);

        return $this->respond(
            (new ResponseFactory)->createResponse(200),
            response()->setData($config)
        );
    }
}
?>