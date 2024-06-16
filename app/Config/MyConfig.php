<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class MyConfig extends BaseConfig
{
    public string $appName = 'MyApplication';
    public string $appEmail = 'webmaster@example.com';
    public bool $register = true;
}
