<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $table = 'overtimes';
    protected $guarded = [];

    public function calendar() {
        return $this->belongsTo(Calendar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
