<?php
namespace Orion\Controllers\Auth;

use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ServerRequestInterface as Request;
use Odan\Session\SessionInterface;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\Annotation\Prefix;
use Sunrise\Http\Router\Annotation\Route;

use Orion\Framework\Controller\BaseController;
use Orion\User\Interfaces\UserInterface;
use Orion\User\Service\Auth\DetermineIpService;
use Orion\User\Service\Auth\LoginService;
use Orion\User\Service\Auth\RegisterService;

#[Prefix('/auth')]
class AuthController extends BaseController {

    public function __construct(
        private DetermineIpService $determineIpService,
        private LoginService $loginService,
        private RegisterService $registerService,
        private SessionInterface $session
    ) {}

    #[Route(
        name: 'sign-in',
        path: '/sign-in',
        methods: ['POST'],
    )]

    /**
     * AuthController Login Method
     * 
     * @param Request  $request
     * @param Response $response
     *
     * @return Response Returns a Response with the given Data
     */
    public function login(Request $request) 
    {
        /** @var array $parsedData */
        $parsedData = $request->getParsedBody();

        /** @var string $determinedIp */
        $determinedIp = $this->determineIpService->execute();

        $parsedData[UserInterface::COLUMN_IP_CURRENT] = $determinedIp;

        $customResponse = $this->loginService->login($parsedData);

        return $this->respond(
            (new ResponseFactory)->createResponse(200),
            $customResponse
        );
    }

    #[Route(
        name: 'account-registration',
        path: '/account-registration',
        methods: ['POST'],
    )]

    /**
     * AuthController Signup Method
     * 
     * @param Request  $request
     * @param Response $response
     *
     * @return Response Returns a Response with the given Data
     */
    public function register(Request $request)
    {
        /** @var array $parsedData */
        $parsedData = $request->getParsedBody();

        /** @var string $determinedIp */
        $determinedIp = $this->determineIpService->execute();

        $parsedData[UserInterface::COLUMN_IP_CURRENT] = $determinedIp;
        $parsedData[UserInterface::COLUMN_IP_REGISTER] = $determinedIp;
        $parsedData[UserInterface::COLUMN_ACCOUNT_CREATED] = time();

        $customResponse = $this->registerService->register($parsedData);

        return $this->respond(
            (new ResponseFactory)->createResponse(200),
            $customResponse
        );
    }

    #[Route(
        name: 'logout',
        path: '/logout',
        methods: ['GET'],
    )]

    /**
     * Returns a response without the Authorization header
     * We could blacklist the token with redis-cache
     *
     * @param Request $request
     *
     * @return Response Returns a Response with the given Data
     */
    public function logout(Request $request)
    {
        $this->session->destroy();

        return (new ResponseFactory)->createResponse(200)->withHeader('Location', '/');
    }
}