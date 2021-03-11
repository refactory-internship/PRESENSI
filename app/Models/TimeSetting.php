<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSetting extends Model
{
    use HasFactory;

    protected $table = 'time_settings';
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
