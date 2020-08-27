<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $primaryKey="id";
    protected $fillable=['foto','carta_presentacion','person_id','specialty_id','office_id'];
    public function person(){
        return $this->belongsTo('App\Person');
    }
    public function specialty(){
        return $this->belongsTo("App\Specialty");
    }
    public function office(){
        return $this->belongsTo('App\Office'); 
    }
    public function users(){
        return $this->belongsToMany('App\User','turns')->withPivot('fecha','hora','tipo','estado');
    }
    public function days(){
        return $this->hasMany('App\CancelDay');
    }
    // public function turns(){
    //     return $his->hasMany('App\Turn');
    // }
}
