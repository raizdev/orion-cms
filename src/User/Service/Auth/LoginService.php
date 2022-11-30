<?php
namespace Orion\User\Service\Auth;

use Orion\Framework\Interfaces\CustomResponseInterface;

/**
 * Class LoginService
 *
 * @package Orion\User\Service\Auth
 */
class LoginService
{
    /**
     * Determines the requested ip
     *
     * @return string|null
     */
    public function login(array $data): CustomResponseInterface
    {
        return response()
        ->setData([
            'pagetime'  => 'home',
            'status'    => 'success',
            'message'   => __('Logged in successfully'),
        ]);
    }
}