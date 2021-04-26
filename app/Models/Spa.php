<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['codeno', 'name', 'price', 'photo', 'description'];

    public function saledetails()
    {
        return $this->hasMany('App\Models\Saledetail');
    }
}
