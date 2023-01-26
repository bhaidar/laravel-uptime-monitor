<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Endpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'frequency',
        'next_check',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function checks(): HasMany
    {
        return $this->hasMany(Check::class)->latest();
    }

    public function check(): HasOne
    {
        return $this->hasOne(Check::class)->latestOfMany();
    }

    public function url(): string
    {
        return $this->site->url() . $this->location;
    }

    public function uptimePercentages(): float|int|null
    {
        if (!$this->checks->count()) {
            return null;
        }

        return number_format(($this->successful_checks_count / $this->checks->count()) * 100, 2);
    }
}
