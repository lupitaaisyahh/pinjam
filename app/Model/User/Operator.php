<?php

namespace App\Model\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Operator extends Authenticatable
{
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    use Notifiable;
    
    protected $table = 'user_operator';

    protected $guard = 'operator';
    
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