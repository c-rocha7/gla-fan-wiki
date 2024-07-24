<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterBaseStatus extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function baseStatus(): BelongsTo
    {
        return $this->belongsTo(BaseStatus::class);
    }
}
