<?php

namespace App\Controllers;

use App\Libraries\Twig;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    protected $session;
    protected $twig;
    protected $myConfig;
    protected $twigConfig;
    protected $validation;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->appConfig = config('AppConfig');
        $this->session = Services::session();
        $this->validation = Services::validation();
        service('eloquent');
        $this->initTwig();
    }

    private function initTwig()
    {
        $this->twigConfig = config('Twig');
        $this->twig = new Twig($this->twigConfig->config);
        $this->twig->addGlobal('appConfig', $this->appConfig);
        $this->twig->addGlobal('session', $this->session);
        $this->twig->addGlobal('validation', $this->validation);
	}
}
