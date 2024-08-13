<?php

declare(strict_types=1);

namespace App\Filament\Resources\Item\EquipmentResource\Pages;

use App\Filament\Resources\Item\EquipmentResource;
use App\Models\EquipmentItemType;
use App\Models\EquipmentTag;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEquipment extends CreateRecord
{
    protected static string $resource = EquipmentResource::class;

    protected function afterCreate(): void
    {
        $itemTypeId = $this->data['item_type_id'];
        $equipmentId = $this->record->id;
        $equipmentItemType = new EquipmentItemType();
        $equipmentItemType->equipment_id = $equipmentId;
        $equipmentItemType->item_type_id = $itemTypeId;
        $equipmentItemType->save();

        $tagId = $this->data['tag_id'];
        $equipmentTag = new EquipmentTag();
        $equipmentTag->equipment_id = $equipmentId;
        $equipmentTag->tag_id = $tagId;
        $equipmentTag->save();
    }
}
