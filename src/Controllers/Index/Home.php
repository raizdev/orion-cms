<?php
namespace Cosmic\App\Controllers\Index;

use Sunrise\Http\Router\Annotation as Mapping;
use Sunrise\Http\Message\ResponseFactory;
use Psr\Http\Message\ServerRequestInterface as Request;

use Orion\Framework\Controller\BaseController;
use Orion\Models\User;

class Home extends BaseController {
  
    #[Mapping\Route('/', path: '/')]
    public function index(Request $request) {

        //debug(User::find(1));

        return $this->twig("home/home");
    }
}
?>