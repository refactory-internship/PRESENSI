<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';
    protected $guarded = [];
    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function getFormattedStartDate()
    {
        return $this->start_date->format('Y-m-d');
    }

    public function getFormattedEndDate()
    {
        return $this->end_date->format('Y-m-d');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
