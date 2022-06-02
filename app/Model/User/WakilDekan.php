<?php

namespace App\Model\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WakilDekan extends Authenticatable
{
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    use Notifiable;
    
    protected $table = 'user_wakildekan';

    protected $guard = 'wakildekan';
    
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