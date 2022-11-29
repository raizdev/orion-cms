<?php
namespace Orion\Controllers\Auth;

use Sunrise\Http\Router\Annotation as Mapping;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Http\Router\Annotation\Prefix;
use Psr\Http\Message\ServerRequestInterface as Request;

use Orion\Framework\Controller\BaseController;
use Orion\User\Interfaces\UserInterface;
use Orion\User\Service\Auth\DetermineIpService;
use Orion\User\Service\Auth\LoginService;

#[Prefix('/auth')]
class AuthController extends BaseController {

    public function __construct(
        private DetermineIpService $determineIpService,
        private LoginService $loginService
    ) {}

    /**
     * @Route(
     *   name="sign-in",
     *   path="/sign-in",
     *   methods={"POST"}
     * )
     */
    public function login(Request $request) 
    {
        /** @var array $parsedData */
        $parsedData = $request->getParsedBody();

        $this->validate($parsedData, [
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
}