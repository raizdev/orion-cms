<?php
namespace KPN\Core\Handler;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

use Sunrise\Http\Message\ResponseFactory;
use Psr\Http\Message\ResponseInterface as Response;

use Exception;

class TwigViewResponseHandler
{
    /**
     * @var Twig_Environment
     */
    private $twig;

   /**
     * @var Twig_Loader_Filesystem
     */
    private $loader;

    protected function createTwig()
    {
        /**
         * check if twig is singleton otherwise create
         */
        if($this->twig !== null ) {
            return;
        }

        if( $this->loader === null ) {
            $this->loader = new FilesystemLoader(dirname(__DIR__) . '/../App/View');
        }

        $twig = new \Twig\Environment($this->loader);

        if( config('website_settings.debug') ) {
            $twig->addExtension( new \Twig\Extension\DebugExtension() );
        }

        $this->twig = $twig;
    }

    public function addGlobal($name, $value) {
        $this->createTwig();
        $this->twig->addGlobal($name, $value);
    }

    private function registerGlobals($settings) 
    {
        $this->twig->addGlobal(
            'ajaxRequest', 
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
        );

        $this->twig->addGlobal(
            'cache_timestamp', 
            $settings->cache_timestamp
        );
    }

    private function registerFunctions()
    {
        $this->twig->addFunction(
            new TwigFunction('lang', [$this, 'getLanguage'])
        );

        $this->twig->addFunction(
            new TwigFunction('config', [$this, 'getConfig'])
        );
    }

    public function getLanguage($variable)
    {
        $lang = LocaleService::get('website.' . $variable);
        return $lang;
    }

    public function getConfig($variable) 
    {
        $config = config($variable);
        return $config;
    }
  
    /**
    * Renders Twig Template and Returns as String
    *
    * @param string $view   Template filename without `.twig`
    * @param array  $params Array of parameters to pass to the template
    * @return string
    */
    public function render( string $view, array $params = [] ): Response
    {
        try
        {
            $this->createTwig();
            $this->registerFunctions();
            
            $view = 'pages/' . $view . '.twig';

            echo $this->twig->render( $view, $params );
            return (new ResponseFactory)->createResponse(200, "twig");
        } 
        catch( Twig_Error_Loader $error_Loader ) 
        {
            throw new PageNotFoundException($error_Loader);
        }
    }
    
}
