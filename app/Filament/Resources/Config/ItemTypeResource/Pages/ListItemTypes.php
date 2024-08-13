<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config\ItemTypeResource\Pages;

use App\Filament\Resources\Config\ItemTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemTypes extends ListRecords
{
    protected static string $resource = ItemTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
