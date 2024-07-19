<?php

declare(strict_types=1);

namespace App\Filament\Resources\Gameplay;

use App\Filament\Resources\Gameplay\IslandResource\Pages;
use App\Models\Island;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IslandResource extends Resource
{
    protected static ?string $model                 = Island::class;
    protected static ?string $modelLabel            = 'Ilha';
    protected static ?string $pluralModelLabel      = 'Ilhas';
    protected static ?string $recordTitleAttribute  = 'name';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
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

                        Forms\Components\RichEditor::make('description')
                            ->label('Descrição')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'undo',
                                'redo',
                            ])
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
            ->emptyStateHeading('Nenhuma Ilha');
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
            'index'  => Pages\ListIslands::route('/'),
            'create' => Pages\CreateIsland::route('/create'),
            'edit'   => Pages\EditIsland::route('/{record}/edit'),
        ];
    }
}
