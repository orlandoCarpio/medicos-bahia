<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    //
    protected $primaryKey='id';
    protected $fillable=['email','pass'];
    public function person(){
        return $this->hasOne('App\Person','login_id');
    }
    
}
