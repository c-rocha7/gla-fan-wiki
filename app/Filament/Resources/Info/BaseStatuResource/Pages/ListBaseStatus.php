<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\BaseStatuResource\Pages;

use App\Filament\Resources\Info\BaseStatuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaseStatus extends ListRecords
{
    protected static string $resource = BaseStatuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
