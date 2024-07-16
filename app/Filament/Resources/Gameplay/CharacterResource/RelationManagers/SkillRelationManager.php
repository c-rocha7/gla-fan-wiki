<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay\CharacterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SkillRelationManager extends RelationManager
{
    protected static string $relationship = 'skill';
    protected static ?string $title       = 'Skill';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    Forms\Components\TextInput::make('level')
                        ->label('Level')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(110)
                        ->required(),
                    Forms\Components\TextInput::make('recharge')
                        ->label('Recarga')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(300)
                        ->required(),
                    Forms\Components\TextInput::make('energy')
                        ->label('Energia')
                        ->numeric()
                        ->minValue(-100)
                        ->maxValue(100)
                        ->required(),
                    Forms\Components\TextInput::make('pve_power')
                        ->label('PVE Power')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->required(),
                    Forms\Components\TextInput::make('pvp_power')
                        ->label('PVP Power')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->required(),
                ])->columns(2),

                Forms\Components\Section::make()->schema([
                    Forms\Components\RichEditor::make('description')
                        ->label('Descrição')
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'undo',
                            'redo',
                        ])
                        ->required(),
                ])->columns(1),

                Forms\Components\Section::make()->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Image')
                        ->image()
                        ->required(),
                    Forms\Components\FileUpload::make('video')
                        ->label('Video')
                        ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                        ->required(),
                ])->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('character_id')
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name'),
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
            ])
            ->emptyStateHeading('Nenhuma Skill')
            ->emptyStateDescription('Adicione Skills ao Personagem');
    }
}
