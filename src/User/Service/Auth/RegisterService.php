<?php
namespace Orion\User\Service\Auth;

use PHLAK\Config\Interfaces\ConfigInterface;
use Odan\Session\SessionInterface;
use Orion\Framework\Interfaces\CustomResponseInterface;
use Orion\Framework\Interfaces\HttpResponseCodeInterface;
use Orion\User\Exception\RegisterException;
use Orion\User\Model\UserModel;
use Orion\User\Entity\User;

/**
 * Class RegisterService
 *
 * @package Orion\User\Service\Auth
 */
class RegisterService
{
    /**
     * RegisterService constructor.
     *
     * @param ConfigInterface       $config
     * @param SessionInterface      $session
     */
    public function __construct(
        private ConfigInterface $config,
        private SessionInterface $session,
        private UserModel $userModel,
        private HashService $hashService
    ) {}

    /**
     * Registers a new User.
     *
     * @param array $data
     */
    public function register(array $data): CustomResponseInterface
    {
        /** @var UserModel $user */
        $user = $this->userModel->where('username', $data['username'])->orWhere('mail', $data['mail'])->get();

        if($user) {
            throw new RegisterException(
                __('Username or E-Mail is already taken'),
                HttpResponseCodeInterface::HTTP_RESPONSE_UNPROCESSABLE_ENTITY
            );
        }

        $this->isEligible($data);

        /** @var UserModel $user */
        debug($this->getNewUser($data));
        $user = $this->userModel->create($data);
        
        $this->session->set('user', $user);

        return response()->setData([
            'status' => 'success',
            'message'   => 'Your account has been created! you will be redirectd',
            'pagetime' => '/',
        ]);
    }


    /**
     * @param $data
     *
     * @return bool
     * @throws RegisterException
     */
    private function isEligible($data): bool
    {
        /** @var int $maxAccountsPerIp */
        $maxAccountsPerIp = $this->config->get('hotel_settings.register.max_accounts_per_ip');
        $accountExistence = $this->userModel->where('ip_register', $data['ip_current'])->count();

        if ($accountExistence >= $maxAccountsPerIp) {
            throw new RegisterException(
                __('You can only have %s Accounts',
                    [$maxAccountsPerIp]),
                HttpResponseCodeInterface::HTTP_RESPONSE_FORBIDDEN
            );
        }

        return true;
    }

    private function getNewUser(array $data): User
    {
        $user = new User();

        return $user
            ->setUsername($data['username'])
            ->setPassword($this->hashService->hash($data['password']))
            ->setMail($data['mail'])
            ->setAccountCreated(time())
            ->setCredits($this->config->get('hotel_settings.start_credits'))
            ->setMotto($this->config->get('hotel_settings.start_motto'))
            ->setIPRegister($data['ip_register'])
            ->setIpCurrent($data['ip_current'])
            ->setLastLogin(time())
            ->setRank(1);
    }
}