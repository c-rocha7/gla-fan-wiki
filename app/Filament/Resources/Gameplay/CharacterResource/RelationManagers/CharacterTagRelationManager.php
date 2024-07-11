<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\CharacterResource\RelationManagers;

use App\Models\CharacterTag;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharacterTagRelationManager extends RelationManager
{
    protected static string $relationship = 'characterTag';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tag_id')
                    ->label('Tag')
                    ->options(function (RelationManager $livewire) {
                        $characterTagIds = $livewire->getOwnerRecord()
                                                    ->characterTag()
                                                    ->get()
                                                    ->map(fn (CharacterTag $characterTag): int => $characterTag->tag_id)
                                                    ->toArray();
                        $tags = Tag::whereNotIn('id', $characterTagIds)->get();
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
            ->recordTitleAttribute('id')
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
