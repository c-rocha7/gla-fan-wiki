<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config\BaseStatusResource\Pages;

use App\Filament\Resources\Config\BaseStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBaseStatus extends CreateRecord
{
    protected static string $resource = BaseStatusResource::class;
}
