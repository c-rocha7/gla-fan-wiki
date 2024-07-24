<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function characterTier(): HasMany
    {
        return $this->hasMany(CharacterTier::class);
    }

    public function characterTag(): HasMany
    {
        return $this->hasMany(CharacterTag::class);
    }

    public function characterBaseStatus(): HasMany
    {
        return $this->hasMany(CharacterBaseStatus::class);
    }

    public function skill(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
