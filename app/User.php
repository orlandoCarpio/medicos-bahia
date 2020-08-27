<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey="id";
    protected $fillable=['person_id'];
    public function person(){
        return $this->belongsTo('App\Person');
    }
    public function doctors(){
        return $this->belongsToMany('App\Doctor','turns')->withPivot('fecha','hora','tipo','estado');
    }
}
