<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\DropResource\Pages;

use App\Filament\Resources\Info\DropResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDrops extends ListRecords
{
    protected static string $resource = DropResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
