<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Country;
use App\Admin\City;

class Warehouse extends Model
{
    protected $guarded = [];

    public function country(){
        
        return $this->belongsTo(Country::class);  
    }
    public function city(){
        return $this->belongsTo(City::class);  
    }

   public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
