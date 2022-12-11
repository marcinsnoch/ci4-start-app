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
 * Class BaseController.
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
     * @var array
     */
    protected $helpers = ['alerts', 'app', 'cookie', 'form', 'url'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->myConfig = config('MyConfig');
        $this->session = Services::session();
        $this->validation = Services::validation();
        service('eloquent');
        $this->initTwig();
    }

    private function initTwig()
    {
        $config = [
            'functions_safe' => [
                'current_url',
                'd',
                'dd',
                'var_dump',
            ],
        ];
        $this->twig = new Twig($config);
        $this->twig->addGlobal('myConfig', $this->myConfig);
        $this->twig->addGlobal('session', $this->session);
        $this->twig->addGlobal('validation', validation_errors());
    }
}
