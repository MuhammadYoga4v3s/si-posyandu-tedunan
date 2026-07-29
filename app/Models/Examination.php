<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'child_id',
    'staff_id',
    'activity_id',
    'weight',
    'height',
    'head_circumference',
    'upper_arm_circumference',
    'development_check',
    'symptoms',
    'nutrition',
    'immunization',
    'vitamin_a',
    'deworming',
    'local_food_program',
    'health_education',
    'referral',
    'notes',
])]
class Examination extends Model
{
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}