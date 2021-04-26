<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'duration', 'brand_id'];

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function items(){
        return $this->hasMany('App\Models\Item');
    }
}
