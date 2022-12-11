<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'token', 'terms', 'updated_at'];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        // $data['data']['token'] = bin2hex(random_bytes(64));
        $data['data']['created_at'] = date('Y-m-d H:i:s');

        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);
        $data['data']['updated_at'] = date('Y-m-d H:i:s');

        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}
