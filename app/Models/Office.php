<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravolt\Indonesia\Models\Village;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';
    protected $guarded = [];

    public function division()
    {
        return $this->belongsToMany(Division::class)->withTimestamps();
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * Get all of the comments for the Office
     *
     * @return HasManyThrough
     */
    public function user(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Division::class);
    }
}
