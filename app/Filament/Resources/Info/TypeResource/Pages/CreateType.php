<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info\TypeResource\Pages;

use App\Filament\Resources\Info\TypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateType extends CreateRecord
{
    protected static string $resource = TypeResource::class;
}
