<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'category_id',
        'amount',
        'date'
    ];
}
