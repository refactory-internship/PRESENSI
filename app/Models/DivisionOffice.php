<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DivisionOffice extends Pivot
{
    use HasFactory;

    protected $table = 'division_office';

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function user()
    {
        return $this->hasMany(User::class, 'division_office_id', 'id');
    }
}
