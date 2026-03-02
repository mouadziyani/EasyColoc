<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'category_id',
        'paid_by',
        'date',
        'colocation_id'
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }
    }
