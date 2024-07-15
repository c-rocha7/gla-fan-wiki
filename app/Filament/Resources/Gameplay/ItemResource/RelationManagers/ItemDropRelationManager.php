<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\ItemResource\RelationManagers;

use App\Models\Drop;
use App\Models\ItemDrop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemDropRelationManager extends RelationManager
{
    protected static string $relationship = 'itemDrop';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('drop_id')
                    ->label('Drop')
                    ->options(function (RelationManager $livewire) {
                        $itemDropIds = $livewire->getOwnerRecord()
                                                    ->itemDrop()
                                                    ->get()
                                                    ->map(fn (ItemDrop $itemDrop): int => $itemDrop->drop_id)
                                                    ->toArray();
                        $drops = Drop::whereNotIn('id', $itemDropIds)->get();
                        return $drops
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
                Tables\Columns\TextColumn::make('drop.name'),
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
