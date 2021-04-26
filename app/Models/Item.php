<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'codeno', 'name', 'liter', 'price', 'photo', 'color', 'description', 'country_id', 'category_id', 'car_id', 'color_id', 'user_id'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function saledetails()
    {
        return $this->hasMany('App\Models\Saledetail');
    }

    public function stocks(){
        return $this->hasMany('App\Models\Stock');
    }
}
