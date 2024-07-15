<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\DropResource\Pages;

use App\Filament\Resources\Info\DropResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDrop extends CreateRecord
{
    protected static string $resource = DropResource::class;
}
