<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saledetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty', 'item_id', 'spa_id', 'sale_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function spa()
    {
        return $this->belongsTo('App\Models\Spa');
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }
}
