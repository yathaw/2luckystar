<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable=['stockdate', 'qty', 'pc', 'type', 'price', 'item_id', 'supplier_id', 'user_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
