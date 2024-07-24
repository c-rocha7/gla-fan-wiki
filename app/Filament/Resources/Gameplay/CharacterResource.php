<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay;

use App\Filament\Resources\Gameplay\CharacterResource\Pages;
use App\Filament\Resources\Gameplay\CharacterResource\RelationManagers\CharacterBaseStatusRelationManager;
use App\Filament\Resources\Gameplay\CharacterResource\RelationManagers\CharacterTagRelationManager;
use App\Models\Character;
use App\Models\Tier;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CharacterResource extends Resource
{
    protected static ?string $model                 = Character::class;
    protected static ?string $modelLabel            = 'Personagem';
    protected static ?string $pluralModelLabel      = 'Personagens';
    protected static ?string $recordTitleAttribute  = 'name';
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
                                titlePlaceholder: 'Digite o nome do personagem:  ',
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

                            Forms\Components\RichEditor::make('description')
                                ->label('Descrição')
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'undo',
                                    'redo',
                                ]),

                            Forms\Components\Select::make('tier_id')
                                ->label('Tier')
                                ->options(function ($context) {
                                    if ('create' == $context) {
                                        $tiers = Tier::all();

                                        return $tiers
                                                ->pluck('name', 'id')
                                                ->toArray();
                                    }

                                    return Tier::pluck('name', 'id')
                                                ->toArray();
                                })
                                ->formatStateUsing(function ($record, $context) {
                                    if ('create' == $context) {
                                        return null;
                                    }

                                    return $record->characterTier()->first()->tier_id;
                                })
                                ->native(false)
                                ->required(),
                        ]),
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

                            Forms\Components\FileUpload::make('image')
                                ->label('Imagem')
                                ->image()
                                ->acceptedFileTypes([
                                    'image/png',
                                ])
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
            ])
            ->emptyStateHeading('Nenhum Personagem');
    }

    public static function getRelations(): array
    {
        return [
            CharacterTagRelationManager::class,
            CharacterBaseStatusRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit'   => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
