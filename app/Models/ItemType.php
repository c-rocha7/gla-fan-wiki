<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemType extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function equipmentItemType(): HasMany
    {
        return $this->hasMany(EquipmentItemType::class);
    }
}
