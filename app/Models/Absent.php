<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;

    protected $table = 'absents';
    protected $guarded = [];
    protected $dates = [
      'date'
    ];

    public function getFormattedDate()
    {
        return $this->date->format('Y-m-d');
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
