<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config;

use App\Filament\Resources\Config\BaseStatusResource\Pages;
use App\Models\BaseStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BaseStatusResource extends Resource
{
    protected static ?string $model                 = BaseStatus::class;
    protected static ?string $modelLabel            = 'Status Base';
    protected static ?string $pluralModelLabel      = 'Status Bases';
    protected static ?string $recordTitleAttribute  = 'name';
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
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBaseStatuses::route('/'),
            'create' => Pages\CreateBaseStatus::route('/create'),
            'edit'   => Pages\EditBaseStatus::route('/{record}/edit'),
        ];
    }
}
