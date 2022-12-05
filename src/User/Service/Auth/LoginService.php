<?php
namespace Orion\User\Service\Auth;

use Odan\Session\SessionInterface;
use Orion\Framework\Interfaces\CustomResponseInterface;
use Orion\Framework\Service\ValidationService;
use Orion\User\Interfaces\UserInterface;
use Orion\User\Exception\LoginException;
use Orion\User\Model\UserModel;

/**
 * Class LoginService
 *
 * @package Orion\User\Service\Auth
 */
class LoginService
{
    /**
     * LoginService constructor.
     *
     * @param UserModel   $userModel
     */
    public function __construct(
        private UserModel $userModel,
        private SessionInterface $session,
        private ValidationService $validationService
    ) {}

    /**
     * Login User.
     *
     * @return string|null
     */
    public function login(array $data): CustomResponseInterface
    {
        $this->validationService->validate($data, [
            UserInterface::COLUMN_USERNAME => 'required',
            UserInterface::COLUMN_PASSWORD => 'required'
        ]);

        $user = $this->userModel->firstWhere('username', $data['username']);

        if (!$user || !password_verify($data['password'], $user->password)) {
            throw new LoginException(
                __('Data combination was not found')
            );
        }

        // TODO implement banService
        
        $user->{UserInterface::COLUMN_IP_CURRENT} = $data[UserInterface::COLUMN_IP_CURRENT];

        $user->save();
        
        $this->session->set('user', $user);

        return response()->setData([
            'pagetime'  => '/',
            'status'    => 'success',
            'message'   => __('Logged in successfully'),
        ]);
    }
}