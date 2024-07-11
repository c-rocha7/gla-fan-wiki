<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\TagResource\Pages;

use App\Filament\Resources\Info\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
