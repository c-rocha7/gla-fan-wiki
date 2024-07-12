<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay;

use App\Filament\Resources\Gameplay\CharacterResource\Pages;
use App\Filament\Resources\Gameplay\CharacterResource\RelationManagers;
use App\Filament\Resources\Gameplay\CharacterResource\RelationManagers\CharacterBaseStatuRelationManager;
use App\Filament\Resources\Gameplay\CharacterResource\RelationManagers\CharacterTagRelationManager;
use App\Filament\Resources\Gameplay\CharacterResource\RelationManagers\SkillRelationManager;
use App\Models\Character;
use App\Models\CharacterBaseStatu;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CharacterResource extends Resource
{
    protected static ?string $model = Character::class;
    protected static ?string $modelLabel            = 'Personagem';
    protected static ?string $pluralModelLabel      = 'Personagens';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\Section::make()->schema([
                        TitleWithSlugInput::make(
                            fieldTitle: 'name',
                            fieldSlug: 'slug',
                            urlHostVisible: false,
                            urlVisitLinkVisible: false,
                            titleLabel: 'Nome',
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

                        Forms\Components\Select::make('tier')
                            ->label('Tier')
                            ->options([
                                '1' => 'Bronze',
                                '2' => 'Prata',
                                '3' => 'Ouro',
                                '4' => 'Diamante',
                            ])
                            ->native(false)
                            ->required(),
                    ]),

                    Forms\Components\Section::make()->schema([
                        Forms\Components\FileUpload::make('icon')
                            ->label('Ícone')
                            ->image()
                            ->required(),

                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->required(),
                    ])->columns(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon'),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            CharacterTagRelationManager::class,
            CharacterBaseStatuRelationManager::class,
            SkillRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacters::route('/'),
            'create' => Pages\CreateCharacter::route('/create'),
            'edit' => Pages\EditCharacter::route('/{record}/edit'),
        ];
    }
}
