<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay;

use App\Filament\Resources\Gameplay\MobResource\Pages;
use App\Filament\Resources\Gameplay\MobResource\RelationManagers;
use App\Models\Mob;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MobResource extends Resource
{
    protected static ?string $model = Mob::class;
    protected static ?string $modelLabel = 'Monstro';
    protected static ?string $pluralModelLabel = 'Monstros';
    protected static string $title = 'Nome';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\COmponents\Section::make()->schema([
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
                        Forms\Components\TextInput::make('life')
                            ->label('Vida')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('attack')
                            ->label('Ataque')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('defense')
                            ->label('Defesa')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('speed')
                            ->label('Velocidade')
                            ->numeric()
                            ->required(),
                    ])->columnSpan(2),

                    Forms\Components\Section::make()->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagem')
                            ->image()
                            ->required(),
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
            ])
            ->emptyStateHeading('Nenhum Monstro')
            ->emptyStateDescription('Adicione Monstros');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMobs::route('/'),
            'create' => Pages\CreateMob::route('/create'),
            'edit' => Pages\EditMob::route('/{record}/edit'),
        ];
    }
}
