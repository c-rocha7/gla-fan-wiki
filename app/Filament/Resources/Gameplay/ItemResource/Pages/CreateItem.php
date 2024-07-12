<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\ItemResource\Pages;

use App\Filament\Resources\Gameplay\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;
}
