<?php
use PHLAK\Config\Config;
use KPN\Core\Interfaces\CustomResponseInterface;
use KPN\Core\Model\CustomResponse;

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
    