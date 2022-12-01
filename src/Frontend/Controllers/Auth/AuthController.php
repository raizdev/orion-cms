<?php
namespace Orion\Controllers\Auth;

use Sunrise\Http\Router\Annotation as Mapping;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\Annotation\Prefix;
use Sunrise\Http\Router\Annotation\Route;

use Orion\Framework\Service\ValidationService;
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
        private ValidationService $validationService,
        private RegisterService $registerService
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

        $this->validationService->validate($parsedData, [
            UserInterface::COLUMN_USERNAME => 'required',
            UserInterface::COLUMN_PASSWORD => 'required'
        ]);

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

        $this->validationService->validate($parsedData, [
            UserInterface::COLUMN_USERNAME => 'required|min:2|max:12|regex:/^[a-zA-Z\d]+$/',
            UserInterface::COLUMN_MAIL => 'required|email|min:9',
            UserInterface::COLUMN_PASSWORD => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        /** @var string $determinedIp */
        $determinedIp = $this->determineIpService->execute();

        $parsedData[UserInterface::COLUMN_IP_CURRENT] = $determinedIp;
        $parsedData[UserInterface::COLUMN_IP_REGISTER] = $determinedIp;

        $customResponse = $this->registerService->register($parsedData);

        return $this->respond(
            (new ResponseFactory)->createResponse(200),
            $customResponse
        );
    }
}