<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\MobResource\Pages;

use App\Filament\Resources\Gameplay\MobResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMob extends EditRecord
{
    protected static string $resource = MobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
