<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $fillable = [
        'name',
        'hour_equivalent'
    ];

    public function proofs()
    {
        return $this->hasMany(Proof::class);
    }
}
