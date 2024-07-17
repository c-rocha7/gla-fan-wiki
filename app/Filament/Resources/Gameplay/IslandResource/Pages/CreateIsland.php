<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\IslandResource\Pages;

use App\Filament\Resources\Gameplay\IslandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIsland extends CreateRecord
{
    protected static string $resource = IslandResource::class;
}
