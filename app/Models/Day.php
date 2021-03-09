<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['currentWeight'];

    public function weight()
    {
        return $this->hasOne(Weight::class, 'day_id', 'id');
    }

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function getCurrentWeightAttribute()
    {
        return $this->weight->weight;
    }

}
