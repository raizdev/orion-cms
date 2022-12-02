<?php
namespace Orion\User\Service\Auth;

use PHLAK\Config\Interfaces\ConfigInterface;

/**
 * Class HashService
 *
 * @package Orion\User\Service\Auth
 */
class HashService
{
    /**
     * HashService constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(
      private ConfigInterface $config
    ) {}

    /**
     * Takes a normal password and hashes it with the given Algorithm
     *
     * @param string $password
     *
     * @return string
     */
    public function hash(string $password): string
    {
        return password_hash(
            $password,
            json_decode(
                $this->config->get('api_settings.password.algorithm')
            ) ?? PASSWORD_ARGON2ID, [
                'memory_cost' => $this->config->get('api_settings.password.memory_cost'),
                'time_cost' => $this->config->get('api_settings.password.time_cost'),
                'threads' => $this->config->get('api_settings.password.threads')
            ]
        );
    }
}