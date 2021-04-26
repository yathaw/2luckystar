<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name', 'phoneno', 'address', 'note', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function stocks(){
        return $this->hasMany('App\Models\Stock');
    }
}
