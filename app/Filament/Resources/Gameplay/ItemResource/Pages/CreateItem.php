<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\ItemResource\Pages;

use App\Filament\Resources\Gameplay\ItemResource;
use App\Models\ItemDrop;
use App\Models\ItemType;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;

    protected function afterCreate(): void
    {
        $typeId = $this->data['type_id'];
        $itemId = $this->record->id;

        $itemType          = new ItemType();
        $itemType->item_id = $itemId;
        $itemType->type_id = $typeId;
        $itemType->save();

        $dropId            = $this->data['drop_id'];
        $itemDrop          = new ItemDrop();
        $itemDrop->item_id = $itemId;
        $itemDrop->drop_id = $dropId;
        $itemDrop->save();
    }
}
