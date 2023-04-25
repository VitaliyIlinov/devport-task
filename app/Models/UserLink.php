<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Builder
 * @property int $id
 * @property string $url
 * @property int $user_id
 * @property Carbon $lifetime
 * @property Carbon $created_at
 * @property Carbon $update_at
 * @property-read string $full_url
 * @property-read User $user
 */
final class UserLink extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'url',
        'lifetime',
    ];

    protected $casts = [
        'lifetime' => 'datetime',
    ];

    protected function fullUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => route('user-links.resolve', ['user_url' => $this->url]),
        );
    }

    public function isLifeTimeExpired(): bool
    {
        return $this->lifetime->lessThan(now());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
