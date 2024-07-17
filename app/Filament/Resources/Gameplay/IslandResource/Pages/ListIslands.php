<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\IslandResource\Pages;

use App\Filament\Resources\Gameplay\IslandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIslands extends ListRecords
{
    protected static string $resource = IslandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
