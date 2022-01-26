<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use AuthenticableTrait;

    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = ['username','email','password','userimage'];
    protected $hidden = [
    'password'
    ];

    public function todo()
    {
        return $this->hasMany('App\Todo','user_id');
    }
}
