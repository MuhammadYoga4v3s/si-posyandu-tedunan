<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'card_tag',
    'full_name',
    'address',
    'rt',
    'rw',
    'family_card_number',
    'national_id',
    'gender',
    'birth_place',
    'birth_date',
    'religion',
    'education',
    'occupation',
    'marital_status',
    'family_relationship',
    'father_name',
    'mother_name',
    'is_resident',
])]
class Child extends Model
{
    protected $guarded = [];
    public function examinations(): HasMany
    {
        return $this->hasMany(Examination::class);
    }
}