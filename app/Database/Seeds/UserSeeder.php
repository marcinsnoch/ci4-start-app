<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Marcin',
                'email' => 'admin@admin.pl',
                'password' => '$2y$10$vBqB8ef.o3XtJPsApSFyqekP4k8sEGCx0/9VMbgTcwp9Fo3lR6/lm', // password
                'is_admin' => 1,
                'remember_token' => null,
                'terms' => 1,
                'token' => null,
                'last_activity' => null,
            ],
            [
                'name' => 'User',
                'email' => 'user@user.pl',
                'password' => '$2y$10$vBqB8ef.o3XtJPsApSFyqekP4k8sEGCx0/9VMbgTcwp9Fo3lR6/lm', // password
                'is_admin' => 0,
                'remember_token' => null,
                'terms' => 0,
                'token' => null,
                'last_activity' => null,
            ],
        ];
        for ($i = 0; $i < count($users); ++$i) {
            $this->db->table('users')->insert($users[$i]);
        }
    }
}
