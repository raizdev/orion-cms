<?php
namespace Orion\Frontend\Controllers\Home;

use Sunrise\Http\Router\Annotation as Mapping;
use Sunrise\Http\Message\ResponseFactory;
use Psr\Http\Message\ServerRequestInterface as Request;

use Orion\Framework\Controller\BaseController;
use Odan\Session\SessionInterface;

class Home extends BaseController {

    public function __construct(
        private SessionInterface $session
    ) {}

    /**
     * @Route(
     *   name="index",
     *   path="/",
     *   methods={"GET", "POST"},
     * )
     */
    public function index(Request $request) 
    {
        debug($this->session);
        return $this->twig("home/home");
    }
}
?>