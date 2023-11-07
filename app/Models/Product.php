<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'short_code',
        'name',
        'short_description',
        'status',
    ];

    public function scopeSupplierId(Builder $query, int $supplierId): void
    {
        $query->where('supplier_id', $supplierId);
    }

    public function productMedia(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }
}
