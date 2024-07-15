<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemDrop extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function drop(): BelongsTo
    {
        return $this->belongsTo(Drop::class);
    }
}
