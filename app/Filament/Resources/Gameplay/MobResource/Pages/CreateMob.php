<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\MobResource\Pages;

use App\Filament\Resources\Gameplay\MobResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMob extends CreateRecord
{
    protected static string $resource = MobResource::class;
}
