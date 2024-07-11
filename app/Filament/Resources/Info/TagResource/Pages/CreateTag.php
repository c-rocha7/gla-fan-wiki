<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\TagResource\Pages;

use App\Filament\Resources\Info\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;
}
