<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialWork extends Model
{
    protected $primaryKey="id";
    protected $fillable=['descripcion'];
    public function people(){
        return $this->belongsToMany('App\Person');
    }
}
