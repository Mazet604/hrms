<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'emp_user', 'emp_pass', 'empid', 'emp_email', 'email_verified_at'
    ];

    protected $hidden = [
        'emp_pass', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->emp_pass;
    }
    
}