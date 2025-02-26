<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Penerbit;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\PenerbitResource\Pages;

class PenerbitResource extends Resource
{
    protected static ?string $model = Penerbit::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_penerbit')->required()->unique(ignoreRecord: true),
                TextInput::make('nama')->required(),
                TextInput::make('alamat')->required(),
                TextInput::make('kota')->required(),
                Select::make('tipe_telepon')
                    ->options([
                        'mobile' => '📱 Mobile',
                        'landline' => '☎️ Area',
                    ])
                    ->reactive()
                    ->native(false)
                    ->afterStateHydrated(fn($set, $get) => $set('tipe_telepon', $get('tipe_telepon'))),

                TextInput::make('telepon')
                    ->mask(
                        fn($get) => $get('tipe_telepon')
                            ? ($get('tipe_telepon') === 'mobile'
                                ? '9999-9999-9999'
                                : '999-9999999')
                            : null
                    )
                    ->placeholder('Enter phone number')
                    ->maxLength(15)
                    ->required()
                    ->afterStateHydrated(
                        fn($set, $get) =>
                        $set('telepon', $get('telepon'))
                    ),

            ]);
    }
    public static function getNavigationBadge(): ?string
    {
        return (string) static::$model::all()->count();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor')->label('No.')
                    ->rowIndex()
                    ->sortable(false)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false),
                TextColumn::make('id_penerbit')->label('ID Penerbit')
                    ->sortable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false)
                    ->searchable(isIndividual: true),
                TextColumn::make('nama')
                    ->sortable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false)
                    ->searchable(isIndividual: true),
                TextColumn::make('alamat')
                    ->sortable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false)
                    ->searchable(isIndividual: true),
                TextColumn::make('kota')
                    ->sortable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false)
                    ->searchable(isIndividual: true),
                TextColumn::make('telepon')
                    ->sortable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false)
                    ->searchable(isIndividual: true),
                    TextColumn::make(name: 'created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make(name: 'updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->defaultSort('id', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation(),
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

    protected static ?string $navigationGroup = 'Admin Management';
    public static function getModelLabel(): string
    {
        return 'Penerbit';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Penerbit';
    }
    protected static ?string $slug = 'penerbit';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenerbits::route('/'),
        ];
    }
}
