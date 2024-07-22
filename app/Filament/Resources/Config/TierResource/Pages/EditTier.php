<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config\TierResource\Pages;

use App\Filament\Resources\Config\TierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTier extends EditRecord
{
    protected static string $resource = TierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
