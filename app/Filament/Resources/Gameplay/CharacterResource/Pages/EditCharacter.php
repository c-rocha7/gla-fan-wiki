<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\CharacterResource\Pages;

use App\Filament\Resources\Gameplay\CharacterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCharacter extends EditRecord
{
    protected static string $resource = CharacterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
