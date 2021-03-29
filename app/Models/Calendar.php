<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendars';
    protected $guarded = [];
    protected $dates = ['date'];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function overtime()
    {
        return $this->hasMany(Overtime::class);
    }
}
