<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExerciseProgram extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['sorting_score'];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }

    public function getSortingScoreAttribute()
    {
        $score = 0;

        if (Auth::user()) {
            $mother = Auth::user()->mother;

            if ($this->is_pregnant == $mother->is_pregnant) {
                $score += 1;

                if($mother->is_pregnant == true) {
                    if ($this->start_month <= $mother->pregnancy_months && $this->end_month >= $mother->pregnancy_months ) {
                        $score += 1;
                    }
                } else {
                    if ($this->start_month <= $mother->baby_months && $this->end_month >= $mother->baby_months ) {
                        $score += 1;
                    }
                }
            }


        }

        return $score;
    }

}
