<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class,'users_fees');
    }
}
