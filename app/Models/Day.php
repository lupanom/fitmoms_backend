<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['weights'];

    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

}
