<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\ItemResource\RelationManagers;

use App\Models\ItemType;
use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemTypeRelationManager extends RelationManager
{
    protected static string $relationship = 'itemType';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type_id')
                    ->label('Tipo')
                    ->options(function (RelationManager $livewire) {
                        $itemTypeIds = $livewire->getOwnerRecord()
                                                    ->itemType()
                                                    ->get()
                                                    ->map(fn (ItemType $itemType): int => $itemType->type_id)
                                                    ->toArray();
                        $types = Type::whereNotIn('id', $itemTypeIds)->get();
                        return $types
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->native(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('item_id')
            ->columns([
                Tables\Columns\TextColumn::make('type.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
