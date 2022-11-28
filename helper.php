<?php
use PHLAK\Config\Config;
use Orion\Framework\Interfaces\CustomResponseInterface;
use Orion\Framework\Model\CustomResponse;

if (!function_exists('__')) {
    /**
     * Takes message and placeholder to translate them to global locale.
     *
     * @param string $key
     * @param array $placeholder
     * @return string
     */
    function __(string $key, array $placeholder = []): string {
        $locale = new \KPN\Core\Model\Locale();
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
        return __DIR__ . '/';
    }
}


if (!function_exists('config')) {
    /**
     * Returns directory path of app.
     *
     * @return string
     */
    
    function config($key = '') {
        $config = new Config(__DIR__ . '/config.json');
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
    