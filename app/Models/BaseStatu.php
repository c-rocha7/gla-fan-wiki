<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseStatu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function characterBaseStatu(): HasMany
    {
        return $this->hasMany(CharacterBaseStatu::class);
    }
}
