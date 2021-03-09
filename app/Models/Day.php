<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [];

    public function weight()
    {
        return $this->belongsTo(Weight::class);
    }

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function getWeightAttribute()
    {
        return $this->weight()->weight;
    }

}
