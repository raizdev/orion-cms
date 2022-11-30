<?php
use PHLAK\Config\Config;
use Orion\Framework\Interfaces\CustomResponseInterface;
use Orion\Framework\Model\CustomResponse;
use Orion\Framework\Model\Container;
use Orion\Framework\Service\SessionService;

use Orion\Framework\Exception\AuthenticationException;
use Orion\Framework\Interfaces\HttpResponseCodeInterface;
use Orion\Models\User;

if (!function_exists('__')) {
    /**
     * Takes message and placeholder to translate them to global locale.
     *
     * @param string $key
     * @param array $placeholder
     * @return string
     */
    function __(string $key, array $placeholder = []): string {
        $locale = new \Orion\Framework\Model\Locale();
        return $locale->translate($key, $placeholder);
    }
}

if (!function_exists('response')) {
    /**
     * Returns instance of custom response.
     *
     * @return CustomResponseInterface
     */
    function response(): CustomResponseInterface {
        return new CustomResponse();
    }
}


if (!function_exists('app_dir')) {
    /**
     * Returns directory path of app.
     *
     * @return string
     */
    function app_dir(): string {
        return __DIR__ . '/../../';
    }
}


if (!function_exists('config')) {
    /**
     * Returns directory path of app.
     *
     * @return string
     */
    
    function config($key = '') {
        $config = new Config(__DIR__ . '/../config/settings.json');
        return $config->get($key);
    }
}

if (!function_exists('debug')) {
    /**
     * Returns directory path of app.
     *
     * @return string
     */
    function debug($string): Response
    {
        echo '<pre>';
        print_r($string);
        exit;
    }
}

if (!function_exists('user')) {

    function user($user_id) {

        $session = new SessionService();
        if(!$session->exists('user') || !empty($user_id)) {
            throw new AuthenticationException(
                __('Not logged in.'),
                200,
                HttpResponseCodeInterface::HTTP_RESPONSE_UNAUTHORIZED
            );
        }

        $user = User::find($user_id);
        if(!$user) {
            throw new AuthenticationException(
                __('User doesnt exists.'),
                200,
                HttpResponseCodeInterface::HTTP_RESPONSE_UNAUTHORIZED
            );
        }

        return $user;
    }
}