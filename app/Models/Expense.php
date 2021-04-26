<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;

    protected $fillable=['expensedate', 'title', 'amount', 'expensetype_id', 'user_id', 'status'];

    public function expensetype(){
        return $this->belongsTo('App\Models\Expensetype');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
