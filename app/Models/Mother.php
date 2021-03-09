<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function today()
    {
        return $this->days->where('date', Carbon::today());
    }

    public function todayWeight()
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $this->id]);
        return $this->weights->where('date', Carbon::today());
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class)->withPivot('day_id');
    }

    public function todayExercises()
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $this->id]);

        return $this->exercises()->wherePivot('day_id', $day->id);
    }

    public function exerciseOfDate($date)
    {
        $newDate = $this->explodeDate($date);

        $day = Day::firstwhere(['date', $newDate, 'mother_id' => $this->id]);

        return $this->exercises()->wherePivot('day_id', $day->id)->get();
    }

    public function food()
    {
        return $this->belongsToMany(Food::class)->withPivot('day_id', 'grams', 'pieces');
    }

    public function todayFood()
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $this->id]);

        return $this->food()->wherePivot('day_id', $day->id);
    }

    public function foodOfDate($date)
    {
        $newDate = $this->explodeDate($date);

        $day = Day::firstwhere(['date', $newDate, 'mother_id' => $this->id]);

        return $this->food()->wherePivot('day_id', $day->id)->get();
    }

    public function drinks()
    {
        return $this->belongsToMany(Drink::class)->withPivot('day_id', 'ml');
    }

    public function todayDrinks()
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $this->id]);

        return $this->drinks()->wherePivot('day_id', $day->id);
    }

    public function drinksOfDate($date)
    {
        $newDate = $this->explodeDate($date);

        $day = Day::firstwhere(['date', $newDate, 'mother_id' => $this->id]);

        return $this->drinks()->wherePivot('day_id', $day->id)->get();
    }

    public function foodAndDrinks()
    {
        return array_merge($this->food->toArray(), $this->drinks->toArray());
    }

    public function foodAndDrinksOfDate($date)
    {
        return array_merge($this->foodOfDate($date)->toArray(),$this->drinksOfDate($date)->toArray());
    }

    public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function explodeDate($date)
    {
        $dateArray = explode('-', $date);
        $year = $dateArray[0];
        $month = $dateArray[1];
        $day = $dateArray[2];

        $newDate = Carbon::create($year, $month, $day);

        return $newDate;
    }
}
