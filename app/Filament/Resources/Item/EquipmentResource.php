<?php

declare(strict_types=1);

namespace App\Filament\Resources\Item;

use App\Filament\Resources\Item\EquipmentResource\Pages;
use App\Filament\Resources\Item\EquipmentResource\RelationManagers;
use App\Models\Equipment;
use App\Models\ItemType;
use App\Models\Tag;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;
    protected static ?string $modelLabel = 'Equipamento';
    protected static ?string $modelPluralLabel = 'Equipamentos';
    protected static ?string $recordTitleAttribute = 'name';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Section::make()->schema([
                            TitleWithSlugInput::make(
                                fieldTitle: 'name',
                                fieldSlug: 'slug',
                                urlHostVisible: false,
                                urlVisitLinkVisible: false,
                                titleLabel: 'Nome',
                                titlePlaceholder: 'Digite o nome do equipamento:  ',
                                titleRules: [
                                    'required',
                                    'string',
                                    'max:255',
                                ],
                                titleRuleUniqueParameters: [
                                    'ignoreRecord' => true,
                                ],
                                slugLabel: 'Slug: ',
                                slugRuleUniqueParameters: [
                                    'ignoreRecord' => true,
                                ],
                            ),

                            Forms\Components\TextInput::make('level')
                                ->label('Level')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(110)
                                ->default(1)
                                ->required(),
                        ]),

                        Forms\Components\Section::make()->schema([
                            Forms\Components\Fieldset::make('Ataque')->schema([
                                Forms\Components\TextInput::make('min_attack')
                                    ->label('Mínimo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                                Forms\Components\TextInput::make('max_attack')
                                    ->label('Máximo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                            ]),

                            Forms\Components\Fieldset::make('Defesa')->schema([
                                Forms\Components\TextInput::make('min_defense')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                                Forms\Components\TextInput::make('max_defense')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                            ]),

                            Forms\Components\Fieldset::make('Vitalidade')->schema([
                                Forms\Components\TextInput::make('min_vitality')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                                Forms\Components\TextInput::make('max_vitality')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                            ]),

                            Forms\Components\Fieldset::make('Crítico')->schema([
                                Forms\Components\TextInput::make('min_critical')
                                    ->label('Mínimo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                                Forms\Components\TextInput::make('max_critical')
                                    ->label('Máximo')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                            ]),

                            Forms\Components\Fieldset::make('Experiência')->schema([
                                Forms\Components\TextInput::make('min_experience')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                                Forms\Components\TextInput::make('max_experience')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                            ]),

                            Forms\Components\Fieldset::make('Sorte')->schema([
                                Forms\Components\TextInput::make('min_luck')
                                    ->label('Mínima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                                Forms\Components\TextInput::make('max_luck')
                                    ->label('Máxima')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(9999),
                            ]),

                            Forms\Components\Fieldset::make('Penetração em Armadura')->schema([
                                Forms\Components\TextInput::make('min_armor_penetration')
                                ->label('Mínima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999),
                            Forms\Components\TextInput::make('max_armor_penetration')
                                ->label('Máxima')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(9999),
                            ]),
                        ])->columns(2),
                    ])->columnSpan(2),

                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\FileUpload::make('icon')
                                ->label('Ícone')
                                ->image()
                                ->acceptedFileTypes([
                                    'image/png',
                                ])
                                ->required(),

                            Forms\Components\Select::make('item_type_id')
                                ->label('Tipo')
                                ->options(function ($context) {
                                    if ('create' == $context) {
                                        $itemTypes = ItemType::all();

                                        return $itemTypes
                                                ->pluck('name', 'id')
                                                ->toArray();
                                    }

                                    return ItemType::pluck('name', 'id')
                                                ->toArray();
                                })
                                ->formatStateUsing(function ($record, $context) {
                                    if ('create' == $context) {
                                        return null;
                                    }

                                    return $record->equipmentItemType()->first()->item_type_id;
                                })
                                ->native(false)
                                ->required(),

                            Forms\Components\Select::make('tag_id')
                                ->label('Tag')
                                ->options(function ($context) {
                                    if ('create' == $context) {
                                        $tags = Tag::all();

                                        return $tags
                                                ->pluck('name', 'id')
                                                ->toArray();
                                    }

                                    return Tag::pluck('name', 'id')
                                                ->toArray();
                                })
                                ->formatStateUsing(function ($record, $context) {
                                    if ('create' == $context) {
                                        return null;
                                    }

                                    return $record->equipmentTag()->first()->tag_id;
                                })
                                ->native(false)
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
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Ícone'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEquipment::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}
