<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginKey extends Model
{
    protected $primaryKey='id';
    protected $fillable=['email','clave'];
}
