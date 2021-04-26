<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expensetype extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name'];

    public function expense(){
        return $this->hasOne('App\Models\Expense');
    }
}
