<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunAll extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
    }
}
