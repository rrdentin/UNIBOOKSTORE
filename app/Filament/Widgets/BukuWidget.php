<?php

namespace App\Filament\Widgets;

use App\Models\Penerbit;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\BukuResource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\TableWidget as BaseWidget;

class BukuWidget extends BaseWidget
{
    protected static ?string $maxHeight = null;
    protected int | string | array $columnSpan = 'full';

     public function table(Table $table): Table
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
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->grow(false)
                    ->alignRight()
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
            ]);
    }
}
