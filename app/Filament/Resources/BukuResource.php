<?php

namespace App\Filament\Resources;

use App\Models\Buku;
use Filament\Tables;
use App\Models\Penerbit;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\BukuResource\Pages;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    public static function getNavigationBadge(): ?string
    {
        return (string) static::$model::all()->count();
    }

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('id_buku')
                ->label('ID Buku')
                ->required()
                ->unique(ignoreRecord: true)
                ->placeholder('Masukkan ID Buku'),

            TextInput::make('kategori')
                ->required()
                ->placeholder('Masukkan Kategori Buku'),

            TextInput::make('nama_buku')
                ->required()
                ->placeholder('Masukkan Nama Buku'),

            TextInput::make('harga')
                ->numeric()
                ->minValue(0)
                ->required()
                ->placeholder('Masukkan Harga Buku'),

            TextInput::make('stok')
                ->numeric()
                ->minValue(0)
                ->required()
                ->placeholder('Masukkan Jumlah Stok'),

            Select::make('id_penerbit')
                ->label('Nama Penerbit')
                ->searchable()
                ->options(
                    \App\Models\Penerbit::query()
                        ->orderBy('nama')
                        ->pluck('nama', 'id')
                        ->toArray()
                )
                ->required()
                ->placeholder('Pilih Penerbit'),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                BukuResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('nomor')->label('No.')
                    ->rowIndex()
                    ->sortable(false)
                    ->wrap()
                    ->grow(false),
                TextColumn::make('id_buku')->label('ID Penerbit')
                    ->sortable()
                    ->wrap()
                    ->grow(false)
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(isIndividual: true),
                TextColumn::make('kategori')
                    ->sortable()
                    ->wrap()
                    ->grow(false)
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(isIndividual: true),
                TextColumn::make('nama_buku')->label('Nama Buku')
                    ->sortable()
                    ->wrap()
                    ->grow(false)
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(isIndividual: true),
                TextColumn::make('harga')
                    ->sortable()
                    ->wrap()
                    ->grow(false)
                    ->alignRight()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.'))
                    ->searchable(isIndividual: true, query: function ($query, $search) {
                        $searchWithoutDots = str_replace('.', '', $search);
                        return $query->whereRaw("REPLACE(harga, '.', '') LIKE ?", ["%$searchWithoutDots%"]);
                    }),
                TextColumn::make('stok')
                    ->sortable()
                    ->wrap()
                    ->alignRight()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false)
                    ->searchable(isIndividual: true),
                TextColumn::make('penerbit.nama')
                    ->label('Nama Penerbit')
                    ->sortable()
                    ->wrap()
                    ->grow(false)
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(
                        isIndividual: true,
                        query: function ($query, $search) {
                            return $query->whereHas('penerbit', function ($q) use ($search) {
                                $q->where('nama', 'like', "%$search%");
                            });
                        }
                    ),
                TextColumn::make(name: 'created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make(name: 'updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('id_penerbit')
                    ->label('Nama Penerbit')
                    ->searchable()
                    ->options(Penerbit::all()->pluck('nama', 'id'))
                    ->multiple()
            ])
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
        return [
            //
        ];
    }
    protected static ?string $navigationGroup = 'Admin Management';
    public static function getModelLabel(): string
    {
        return 'Buku';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Buku';
    }
    protected static ?string $slug = 'buku';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBukus::route('/'),
        ];
    }
}
