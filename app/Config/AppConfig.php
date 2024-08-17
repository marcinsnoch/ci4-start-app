<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AppConfig extends BaseConfig
{
    public string $appName = 'My Equipment';
    public string $appEmail = 'webmaster@example.com';
    public bool $register = true;
}
