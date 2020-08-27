<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $primaryKey="id";
    protected $fillable=['dni','apellido','nombre','fecha_nac','domicilio','tipo','telefono','login_id'];
    public function login(){
        $this->belongsTo('App\Login');
    }
    public function doctor(){
        return $this->hasOne('App\Doctor');
    }
    public function user(){
        return $this->hasOne('App\User');
    }
    public function socialWorks(){
        return $this->belongsToMany('App\SocialWork');
    }
    //
}
