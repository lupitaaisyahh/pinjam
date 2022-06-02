<?php

namespace App\Model\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    use Notifiable;
    
    protected $table = 'mahasiswa';

    protected $guard = 'mahasiswa';
    
    protected $fillable = [
        'email',
        'password',
        'last_login_at',
        'last_login_ip',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

}