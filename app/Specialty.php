<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $primaryKey="id";
    protected $fillable=['descripcion'];
    public function doctor(){
        return $this->hasMany('App\Doctor');
    }
    //
}
