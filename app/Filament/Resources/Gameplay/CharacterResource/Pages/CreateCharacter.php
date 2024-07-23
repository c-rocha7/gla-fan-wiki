<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\CharacterResource\Pages;

use App\Filament\Resources\Gameplay\CharacterResource;
use App\Models\CharacterTier;
use Filament\Resources\Pages\CreateRecord;

class CreateCharacter extends CreateRecord
{
    protected static string $resource = CharacterResource::class;

    protected function afterCreate(): void
    {
        $tierId                      = $this->data['tier_id'];
        $characterId                 = $this->record->id;
        $characterTier               = new CharacterTier();
        $characterTier->character_id = $characterId;
        $characterTier->tier_id      = $tierId;
        $characterTier->save();
    }
}
