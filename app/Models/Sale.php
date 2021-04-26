<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;

    protected $fillable=['invoiceno', 'saledate', 'total', 'discount', 'paymoney', 'customer_id', 'user_id'];

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function saledetails()
    {
        return $this->hasMany('App\Models\Saledetail');
    }
}
