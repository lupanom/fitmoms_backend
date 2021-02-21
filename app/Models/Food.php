<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mother()
    {
        return $this->belongsToMany(Mother::class)->withPivot('day_id', 'grams');
    }

    public function foodCategory()
    {
        return $this->belongsTo(FoodCategory::class);
    }
}
