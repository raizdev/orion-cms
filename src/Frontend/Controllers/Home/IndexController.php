<?php
namespace Orion\Frontend\Controllers\Home;

use Sunrise\Http\Router\Annotation as Mapping;
use Sunrise\Http\Message\ResponseFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Orion\Framework\Service\TwigService;
use Orion\Framework\Controller\BaseController;

class Home extends BaseController {

    public function __construct(
        private TwigService $twig
    ) {}

    /**
     * @Route(
     *   name="index",
     *   path="/",
     *   methods={"GET"},
     * )
     */
    public function index(Request $request) 
    {
        return $this->twig->render(
            (new ResponseFactory)->createResponse(200),
            'home/home.twig'
        );
    }
}
?>
