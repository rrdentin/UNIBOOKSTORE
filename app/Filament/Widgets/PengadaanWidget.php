<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use Filament\Tables;
use App\Models\Penerbit;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\TableWidget as BaseWidget;

class PengadaanWidget extends BaseWidget
{
    protected static ?string $maxHeight = null; 
    protected int | string | array $columnSpan = 'full'; 
    
    public function table(Table $table): Table
    {
        $stokTerendah = Buku::min('stok'); // Ambil stok paling sedikit

        return $table
            ->query(
                Buku::query()
                    ->orderBy('stok', 'asc') // Urutkan dari stok terkecil
            )
            ->defaultPaginationPageOption(10)
            ->columns([
                TextColumn::make('nomor')->label('No.')
                    ->rowIndex()
                    ->sortable(false)
                    ->wrap()
                    ->grow(false)
                    ->color(fn ($record) => $record->stok == $stokTerendah ? 'danger' : 'gray'),

                TextColumn::make('nama_buku')->label('Nama Buku')
                    ->sortable()
                    ->wrap()
                    ->grow(false)
                    ->toggleable(false)
                    ->searchable(true)
                    ->color(fn ($record) => $record->stok == $stokTerendah ? 'danger' : 'gray'),

                TextColumn::make('penerbit.nama')->label('Nama Penerbit')
                    ->sortable()
                    ->wrap()
                    ->grow(false)
                    ->toggleable(false)
                    ->searchable(true)
                    ->color(fn ($record) => $record->stok == $stokTerendah ? 'danger' : 'gray'),

                TextColumn::make('stok')->label('Stok Tersisa')
                    ->sortable()
                    ->wrap()
                    ->toggleable(false)
                    ->grow(false)
                    ->alignRight()
                    ->searchable(true)
                    ->color(fn ($record) => $record->stok == $stokTerendah ? 'danger' : 'gray'),
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
