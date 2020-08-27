<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Turn extends Pivot
{
    protected $primarykey='id';
    protected $fillable=['fecha','hora','tipo','estado','doctor_id','user_id'];
}
