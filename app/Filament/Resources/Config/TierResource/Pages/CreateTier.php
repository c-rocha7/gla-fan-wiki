<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config\TierResource\Pages;

use App\Filament\Resources\Config\TierResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTier extends CreateRecord
{
    protected static string $resource = TierResource::class;
}
