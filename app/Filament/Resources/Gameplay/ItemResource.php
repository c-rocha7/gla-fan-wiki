<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay;

use App\Filament\Resources\Gameplay\ItemResource\Pages;
use App\Filament\Resources\Gameplay\ItemResource\RelationManagers;
use App\Filament\Resources\Gameplay\ItemResource\RelationManagers\ItemDropRelationManager;
use App\Filament\Resources\Gameplay\ItemResource\RelationManagers\ItemTagRelationManager;
use App\Filament\Resources\Gameplay\ItemResource\RelationManagers\ItemTypeRelationManager;
use App\Models\Drop;
use App\Models\Item;
use App\Models\ItemDrop;
use App\Models\ItemType;
use App\Models\Type;
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
    protected static ?string $recordTitleAttribute  = 'name';
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
                                ->default(1)
                                ->required(),

                            Forms\Components\Fieldset::make('Vitalidade')->schema([
                                Forms\Components\TextInput::make('min_vitality')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('max_vitality')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                            ]),

                            Forms\Components\Fieldset::make('Ataque')->schema([
                                Forms\Components\TextInput::make('min_attack')
                                    ->label('Mínimo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('max_attack')
                                    ->label('Máximo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                            ]),

                            Forms\Components\Fieldset::make('Defesa')->schema([
                                Forms\Components\TextInput::make('min_defense')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('max_defense')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                            ]),

                            Forms\Components\Fieldset::make('Experiência')->schema([
                                Forms\Components\TextInput::make('min_experience')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('max_experience')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                            ]),

                            Forms\Components\Fieldset::make('Sorte')->schema([
                                Forms\Components\TextInput::make('min_luck')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('max_luck')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                            ]),

                            Forms\Components\Fieldset::make('Penetração')->schema([
                                Forms\Components\TextInput::make('min_armor_penetration')
                                ->label('Mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->default(1)
                                ->required(),
                            Forms\Components\TextInput::make('max_armor_penetration')
                                ->label('Máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999)
                                ->default(1)
                                ->required(),
                            ]),

                            Forms\Components\Fieldset::make()->schema([
                                Forms\Components\TextInput::make('min_critical')
                                    ->label('Mínimo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('max_critical')
                                    ->label('Máximo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999)
                                    ->default(1)
                                    ->required(),
                            ]),

                        ])->columns(2),
                    ])->columnSpan(2),

                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\FileUpload::make('image')
                                ->label('Imagem')
                                ->image(),
                            Forms\Components\Select::make('type_id')
                                ->label('Tipo')
                                ->options(Function ($context) {
                                    if ($context == 'create') {
                                        $types = Type::all();
                                        return $types
                                            ->pluck('name', 'id')
                                            ->toArray();
                                    }
                                    return Type::pluck('name', 'id')
                                                ->toArray();
                                })
                                ->formatStateUsing(function ($record, $context) {
                                    if ($context == 'create') {
                                        return null;
                                    }
                                    return $record->itemType()->first()->type_id;
                                })
                                ->required(),
                            Forms\Components\Select::make('drop_id')
                                ->label('Drop')
                                ->options(function ($context) {
                                    if ($context == 'create') {
                                        $drops = Drop::all();
                                        return $drops
                                            ->pluck('name', 'id')
                                            ->toArray();
                                    }
                                    return Drop::pluck('name', 'id')
                                                ->toArray();
                                })
                                ->formatStateUsing(function ($record, $context) {
                                    if ($context == 'create') {
                                        return null;
                                    }
                                    return $record->itemDrop()->first()->drop_id;
                                })
                                ->required(),
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
