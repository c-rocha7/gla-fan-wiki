<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\CharacterResource\RelationManagers;

use App\Models\BaseStatus;
use App\Models\CharacterBaseStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CharacterBaseStatusRelationManager extends RelationManager
{
    protected static string $relationship = 'characterBaseStatus';
    protected static ?string $title       = 'Status Base';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\Section::make()->schema([
                        Forms\Components\Select::make('base_status_id')
                            ->label('Status Base')
                            ->options(function (RelationManager $livewire) {
                                $characterBaseStatusIds = $livewire->getOwnerRecord()
                                                            ->characterBaseStatus()
                                                            ->get()
                                                            ->map(fn (CharacterBaseStatus $characterBaseStatus): int => $characterBaseStatus->base_status_id)
                                                            ->toArray();
                                $baseStatus = BaseStatus::whereNotIn('id', $characterBaseStatusIds)->get();

                                return $baseStatus
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->formatStateUsing(fn ($record): ?string => $record?->baseStatus->name)
                            ->native(false)
                            ->required(),

                        Forms\Components\TextInput::make('value')
                            ->label('Valor')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->default(1)
                            ->required(),
                    ])->columns(2),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle(fn ($record): string => $record->baseStatus->name)
            ->columns([
                Tables\Columns\TextColumn::make('baseStatus.name')
                    ->label('Status Base'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor'),
            ])
            ->filters([])
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
