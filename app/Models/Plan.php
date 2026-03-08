<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration'
    ];

    public function membership(){
        return $this->hasMany(Membership::class);
    }
}
