<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\BaseStatuResource\Pages;

use App\Filament\Resources\Info\BaseStatuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBaseStatu extends CreateRecord
{
    protected static string $resource = BaseStatuResource::class;
}
