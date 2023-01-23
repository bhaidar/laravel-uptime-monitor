<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'default',
        'domain',
        'scheme',
        'notification_emails',
    ];

    public $casts = [
        'notification_emails' => AsArrayObject::class, // array
    ];

    public function url()
    {
        return $this->scheme . '://' . $this->domain;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function endpoints(): HasMany
    {
        return $this->hasMany(Endpoint::class)
            ->withCount(['checks as successful_checks_count' => function ($query) { // needed to calculate successful checks
                $query->where('response_code', 200);
            }])
            ->latest();
    }
}
