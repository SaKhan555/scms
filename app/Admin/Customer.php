<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Country;
use App\Admin\City;


class Customer extends Model
{
   
   protected $guarded = [];

public function country() {
	return	$this->belongsTo(Country::class);
}

public function city() {
	return	$this->belongsTo(City::class);
}
}
