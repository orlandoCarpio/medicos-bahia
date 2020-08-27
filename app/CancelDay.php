<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelDay extends Model
{
    protected $primaryKey='id';
    protected $fillable=['fecha','doctor_id'];
    public function doctor(){
        return $this->belongsTo('App\Doctor');
    }
}
