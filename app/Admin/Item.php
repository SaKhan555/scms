<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\ItemCategory;

class Item extends Model
{
    protected $fillable = ['user_id','item_code_number','item_category_id','name','image_url','details'];

public function item_category() {
	return $this->belongsTo(ItemCategory::class);
}

}