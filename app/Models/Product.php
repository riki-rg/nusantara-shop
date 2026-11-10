<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price_cents',
        'discount_percent',
        'stock',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /** Harga final setelah diskon (di cents). */
    public function finalPriceCents(): int
    {
        return (int) round($this->price_cents * (100 - $this->discount_percent) / 100);
    }

    public function priceInRupiah(int $cents = null): string
    {
        $cents ??= $this->finalPriceCents();

        return 'Rp ' . number_format($cents / 100, 0, ',', '.');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $term
            ? $query->where(fn ($q) => $q
                ->where('name', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%"))
            : $query;
    }
}
