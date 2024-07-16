<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info;

use App\Filament\Resources\Info\DropResource\Pages;
use App\Models\Drop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DropResource extends Resource
{
    protected static ?string $model                 = Drop::class;
    protected static ?string $modelLabel            = 'Drop';
    protected static ?string $pluralModelLabel      = 'Drops';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
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
            'index'  => Pages\ListDrops::route('/'),
            'create' => Pages\CreateDrop::route('/create'),
            'edit'   => Pages\EditDrop::route('/{record}/edit'),
        ];
    }
}
