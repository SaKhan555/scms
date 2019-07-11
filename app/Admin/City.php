<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    
    protected $fillable = ['user_id','country_id','name'];
    
    public function country() {
        return $this->belongsTo(Country::class);
    }
    
}
