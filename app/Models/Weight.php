<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
