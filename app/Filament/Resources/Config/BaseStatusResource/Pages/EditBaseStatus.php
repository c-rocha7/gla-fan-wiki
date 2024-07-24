<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config\BaseStatusResource\Pages;

use App\Filament\Resources\Config\BaseStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaseStatus extends EditRecord
{
    protected static string $resource = BaseStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
