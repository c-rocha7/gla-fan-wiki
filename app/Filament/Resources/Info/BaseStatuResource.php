<?php

declare(strict_types=1);

namespace App\Filament\Resources\Info;

use App\Filament\Resources\Info\BaseStatuResource\Pages;
use App\Models\BaseStatu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BaseStatuResource extends Resource
{
    protected static ?string $model                 = BaseStatu::class;
    protected static ?string $modelLabel            = 'Status Base';
    protected static ?string $pluralModelLabel      = 'Status Base';
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),
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
            ->emptyStateHeading('Nenhum Status Base');
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
            'index'  => Pages\ListBaseStatus::route('/'),
            'create' => Pages\CreateBaseStatu::route('/create'),
            'edit'   => Pages\EditBaseStatu::route('/{record}/edit'),
        ];
    }
}
