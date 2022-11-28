<?php
namespace Cosmic\App\Controllers\Index;

use Orion\Framework\Controller\BaseController;
use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sunrise\Http\Message\ResponseFactory;

class Home extends BaseController {
  
    #[Mapping\Route('/', path: '/')]
    public function index(Request $request) {
        return $this->twig("home/home");
    }
}
?>