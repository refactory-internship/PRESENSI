<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';
    protected $guarded = [];

    public function office()
    {
        return $this->belongsToMany(Office::class)->withTimestamps();
    }

    public function time_settings()
    {
        return $this->hasMany(TimeSetting::class);
    }
}
