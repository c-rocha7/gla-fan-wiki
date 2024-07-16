<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info;

use App\Filament\Resources\Info\TypeResource\Pages;
use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TypeResource extends Resource
{
    protected static ?string $model                 = Type::class;
    protected static ?string $modelLabel            = 'Tipo';
    protected static ?string $pluralModelLabel      = 'Tipos';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\Section::make([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTypes::route('/'),
            'create' => Pages\CreateType::route('/create'),
            'edit'   => Pages\EditType::route('/{record}/edit'),
        ];
    }
}
