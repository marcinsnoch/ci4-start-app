<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_admin',
        'remember_token',
        'terms',
        'token',
        'last_activity',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
