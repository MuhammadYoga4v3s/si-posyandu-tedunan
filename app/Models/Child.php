<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    use HasFactory;

    // Hapus Atribut #[Fillable] dan $guarded, kita gunakan protected $fillable standar
    protected $fillable = [
        'card_tag',
        'full_name',
        'address',
        'rt',
        'rw',
        'dusun', 
        'family_card_number',
        'national_id',
        'gender',
        'birth_place',
        'birth_date',
        'birth_weight', 
        'birth_length', 
        'phone', 
        'notes', 
        'religion',
        'education',
        'occupation',
        'marital_status',
        'family_relationship',
        'father_name',
        'mother_name',
        'is_resident',
    ];

    public function examinations(): HasMany
    {
        return $this->hasMany(Examination::class);
    }
}