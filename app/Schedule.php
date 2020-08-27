<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey="id";
    protected $fillable=['dia','hora_entrada_M','hora_entrada_T','hora_salida_M','hora_salida_T','office_id'];
    public function office(){
        return $this->belongsTo('App\Office');
    }
}
