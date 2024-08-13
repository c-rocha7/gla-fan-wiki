<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config\ItemTypeResource\Pages;

use App\Filament\Resources\Config\ItemTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItemType extends CreateRecord
{
    protected static string $resource = ItemTypeResource::class;
}
