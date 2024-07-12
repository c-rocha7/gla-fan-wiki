<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CharacterBaseStatu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function baseStatu(): BelongsTo
    {
        return $this->belongsTo(BaseStatu::class);
    }
}
