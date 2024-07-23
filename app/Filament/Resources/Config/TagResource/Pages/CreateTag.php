<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config\TagResource\Pages;

use App\Filament\Resources\Config\TagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;
}
