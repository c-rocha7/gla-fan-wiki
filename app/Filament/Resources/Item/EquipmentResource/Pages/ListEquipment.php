<?php

declare(strict_types=1);

namespace App\Filament\Resources\Item\EquipmentResource\Pages;

use App\Filament\Resources\Item\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEquipment extends ListRecords
{
    protected static string $resource = EquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
