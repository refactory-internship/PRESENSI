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

    public function getInitialsAttribute()
    {
        $name = $this->name;
        $name_array = explode(' ', trim($name));
        $first_word = $name_array[0];
        $last_word = $name_array[count($name_array) - 1];
        return $first_word[0] . '' . $last_word[0];
    }
}
