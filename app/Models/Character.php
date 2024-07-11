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
        'id'
    ];

    public function characterTag(): HasMany
    {
        return $this->hasMany(CharacterTag::class);
    }
}
