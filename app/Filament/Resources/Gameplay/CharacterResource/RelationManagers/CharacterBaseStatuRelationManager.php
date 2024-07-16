<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\CharacterResource\RelationManagers;

use App\Models\BaseStatu;
use App\Models\CharacterBaseStatu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharacterBaseStatuRelationManager extends RelationManager
{
    protected static string $relationship = 'characterBaseStatu';
    protected static ?string $title = 'Status Base';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('base_statu_id')
                    ->label('Tag')
                    ->options(function (RelationManager $livewire) {
                        $characterBaseStatuIds = $livewire->getOwnerRecord()
                                                    ->characterBaseStatu()
                                                    ->get()
                                                    ->map(fn (CharacterBaseStatu $characterBaseStatu): int => $characterBaseStatu->base_statu_id)
                                                    ->toArray();
                        $baseStatus = BaseStatu::whereNotIn('id', $characterBaseStatuIds)->get();
                        return $baseStatus
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->native(false)
                    ->required(),

                Forms\Components\TextInput::make('value')
                    ->label('Valor')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('base_statu_id')
            ->columns([
                Tables\Columns\TextColumn::make('baseStatu.name'),
                Tables\Columns\TextColumn::make('value'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Adicionar Status Base')
                    ->modalSubmitActionLabel('Adicionar Status Base')
                    ->modalCancelActionLabel('Cancelar')
                    ->modalHeading('Adicionar Status Base ao Personagem')
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
            ->emptyStateHeading('Nenhum Status Base')
            ->emptyStateDescription('Adicione um Status Base ao Personagem');
    }
}
