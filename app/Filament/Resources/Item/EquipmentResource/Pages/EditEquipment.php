<?php

declare(strict_types=1);

namespace App\Filament\Resources\Item\EquipmentResource\Pages;

use App\Filament\Resources\Item\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEquipment extends EditRecord
{
    protected static string $resource = EquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $itemTypeId = $this->data['item_type_id'];
        $equipmentItemType = $this->record->equipmentItemType()->first();
        $equipmentItemType->item_type_id = $itemTypeId;
        $equipmentItemType->save();

        $tagId = $this->data['tag_id'];
        $equipmentTag = $this->record->equipmentTag()->first();
        $equipmentTag->tag_id = $tagId;
        $equipmentTag->save();
    }
}
