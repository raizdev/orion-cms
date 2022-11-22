<?php
namespace Cosmic\App\Controllers;

use KPN\Core\Controller\BaseController;
use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sunrise\Http\Message\ResponseFactory;

class Index extends BaseController {
  
    #[Mapping\Route('/', path: '/')]
    public function index(Request $request) {
        return $this->twig("home");
    }
}
?>