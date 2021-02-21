<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exercise_category()
    {
        return $this->belongsTo(ExerciseCategory::class);
    }

    public function mothers()
    {
        return $this->belongsToMany(Mother::class);
    }

    public function exercisePrograms()
    {
        return $this->belongsToMany(ExerciseProgram::class);
    }

}
