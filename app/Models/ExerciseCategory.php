<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExerciseCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function getSortingScoreAttribute(Mother $mother)
    {
        $score = 0;

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

        return $score;
    }
}
