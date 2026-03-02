<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable=[
        'name',
        'description',
        'address',
        'owner_id',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'memberships')
                    ->withPivot('role', 'joined_at');
    }
}
