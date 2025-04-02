<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Masquer le mot de passe et autres attributs sensibles
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relations vers Admin ou Student
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
