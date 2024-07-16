<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\ItemResource\Pages;

use App\Filament\Resources\Gameplay\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave()
    {
        $typeId = $this->data['type_id'];

        $itemType = $this->record->itemType()->first();
        $itemType->type_id = $typeId;
        $itemType->save();

        $dropId = $this->data['drop_id'];

        $itemDrop = $this->record->itemDrop()->first();
        $itemDrop->drop_id = $dropId;
        $itemDrop->save();
    }
}
