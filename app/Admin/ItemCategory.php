<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $fillable = ['name','user_id'];
}
