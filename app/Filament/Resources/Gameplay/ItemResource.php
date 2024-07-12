<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay;

use App\Filament\Resources\Gameplay\ItemResource\Pages;
use App\Filament\Resources\Gameplay\ItemResource\RelationManagers;
use App\Filament\Resources\Gameplay\ItemResource\RelationManagers\ItemTagRelationManager;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;
    protected static ?string $modelLabel            = 'Item';
    protected static ?string $pluralModelLabel      = 'Itens';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nome')
                                ->required(),
                            Forms\Components\TextInput::make('level')
                                ->label('Level')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(110)
                                ->required(),
                            Forms\Components\TextInput::make('min_vitality')
                                ->label('Vitalidade mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('max_vitality')
                                ->label('Vitalidade máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('min_defense')
                                ->label('Defesa mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('max_defense')
                                ->label('Defesa máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('min_experience')
                                ->label('Experiencia mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('max_experience')
                                ->label('Experiencia máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('min_luck')
                                ->label('Sorte mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('max_luck')
                                ->label('Sorte máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('min_attack')
                                ->label('Ataque mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('max_attack')
                                ->label('Ataque máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('min_armor_penetration')
                                ->label('Penetração mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('max_armor_penetration')
                                ->label('Penetração máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('min_critical')
                                ->label('Crítico mínimo')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                            Forms\Components\TextInput::make('max_critical')
                                ->label('Crítico máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->required(),
                        ])->columns(2),
                    ])->columnSpan(2),

                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\FileUpload::make('image')
                                ->label('Imagem')
                                ->image(),
                        ]),
                    ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemTagRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
