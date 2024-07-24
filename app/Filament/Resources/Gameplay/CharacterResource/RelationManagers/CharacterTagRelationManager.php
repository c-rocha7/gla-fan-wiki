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

class CharacterTagRelationManager extends RelationManager
{
    protected static string $relationship = 'characterTag';
    protected static ?string $title       = 'Tag';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\Section::make('Tag')->schema([
                        Forms\Components\Select::make('tag_id')
                            ->label('')
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
                            ->formatStateUsing(fn ($record): string => $record->tag->name)
                            ->native(false)
                            ->required(),
                    ]),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle(fn ($record): string => $record->tag->name)
            ->columns([
                Tables\Columns\TextColumn::make('tag.name')
                    ->label('Tag'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Adicionar Tag')
                    ->modalSubmitActionLabel('Adicionar Tag')
                    ->modalCancelActionLabel('Cancelar')
                    ->modalHeading('Adicionar Tags ao Personagem')
                    ->createAnother(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Nenhuma Tag')
            ->emptyStateDescription('Adicione Tags ao personagem.');
    }
}