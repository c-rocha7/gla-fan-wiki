<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\ItemResource\Pages;

use App\Filament\Resources\Gameplay\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
