<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\TypeResource\Pages;

use App\Filament\Resources\Info\TypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypes extends ListRecords
{
    protected static string $resource = TypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
