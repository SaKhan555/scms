<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['user_id','name'];

    public function cities() {
        return $this->hasMany(City::class);
    }
    
}
