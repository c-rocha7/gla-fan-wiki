<?php

declare(strict_types=1);

namespace App\Filament\Resources\Config;

use App\Filament\Resources\Config\TierResource\Pages;
use App\Models\Tier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TierResource extends Resource
{
    protected static ?string $model                 = Tier::class;
    protected static ?string $modelLabel            = 'Tier';
    protected static ?string $pluralModelLabel      = 'Tiers';
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
            ->emptyStateHeading('Nenhum Tier');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTiers::route('/'),
            'create' => Pages\CreateTier::route('/create'),
            'edit'   => Pages\EditTier::route('/{record}/edit'),
        ];
    }
}
