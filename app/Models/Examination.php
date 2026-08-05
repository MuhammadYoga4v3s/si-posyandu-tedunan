<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'staff_id',
        'activity_id',
        
        'weight',
        'weight_result',
        'weight_for_age',
        'height',
        'height_for_age',
        'weight_for_height',
        'head_circumference',
        'head_circumference_status',
        'upper_arm_circumference',
        'upper_arm_status',
        
        'development_check',
        'cough_two_weeks',
        'fever_two_weeks',
        'weight_not_increasing',
        'tb_contact',
        
        'exclusive_breastfeeding',
        'complementary_feeding',
        'immunization',
        'vitamin_a',
        'deworming',
        'local_food_program',
        
        'pmt_portion', 
        
        'health_education',
        'illness_symptoms',
        'referral',
        'notes',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}