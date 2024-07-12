<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\ItemResource\RelationManagers;

use App\Models\ItemTag;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemTagRelationManager extends RelationManager
{
    protected static string $relationship = 'itemTag';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tag_id')
                    ->label('Tag')
                    ->options(function (RelationManager $livewire) {
                        $itemTagIds = $livewire->getOwnerRecord()
                                                    ->itemTag()
                                                    ->get()
                                                    ->map(fn (ItemTag $itemTag): int => $itemTag->tag_id)
                                                    ->toArray();
                        $tags = Tag::whereNotIn('id', $itemTagIds)->get();
                        return $tags
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
                Tables\Columns\TextColumn::make('tag.name'),
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
