<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\CharacterResource\Pages;

use App\Filament\Resources\Gameplay\CharacterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCharacter extends CreateRecord
{
    protected static string $resource = CharacterResource::class;
}
