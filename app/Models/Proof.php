<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $fillable = [
        'user_id',
        'activity_type_id',
        'title',
        'file_path',
        'hours_earned',
        'note',
        'status',
        'submitted_at',
        'approved_at'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
