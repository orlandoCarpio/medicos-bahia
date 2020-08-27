<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $primaryKey="id";
    protected $fillable=['barrio','calle','numero','piso','oficina','latitud','longitud','telefono','intervalo_atencion','intervalo_consulta','tipo_atencion','ubicacion'];
    public function doctor(){
        return $this->hasOne('App\Doctor');
    }
    public function schedules(){
        return $this->hasMany('App\Schedule');
    }
}
