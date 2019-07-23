<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\ItemCategory;

class Item extends Model
{
    protected $guarded = [];

public function item_category() {
	return $this->belongsTo(ItemCategory::class);
}

}