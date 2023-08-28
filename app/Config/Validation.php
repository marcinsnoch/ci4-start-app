<?php

namespace Config;

use App\Validation\UserRules;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        UserRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $login = [
        'email' => 'required|min_length[6]|max_length[50]|valid_email',
        'password' => 'required|min_length[8]|max_length[255]',
    ];

    public array $register = [
        'name' => [
            'label' => 'Full name',
            'rules' => 'required|min_length[3]|max_length[20]'
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required|min_length[8]|max_length[255]',
        ],
        'confirm_password' => [
            'label' => 'Confirm password',
            'rules' => 'required|matches[password]',
        ],
    ];

    public array $user_email = [
        'email' => 'required|trim|valid_email|is_not_unique[users.email]',
    ];

    public array $reset_password = [
        'password' => 'required|min_length[8]',
        'confirm_password' => 'required|matches[password]',
    ];
}
