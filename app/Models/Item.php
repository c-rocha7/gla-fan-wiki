<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function itemTag(): HasMany
    {
        return $this->hasMany(ItemTag::class);
    }

    public function itemType(): HasMany
    {
        return $this->hasMany(ItemType::class);
    }
}
