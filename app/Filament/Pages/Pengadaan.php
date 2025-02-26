<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\PengadaanWidget;

class Pengadaan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.pengadaan';


    protected static ?string $navigationLabel = 'Kebutuhan Buku'; // Navigation label
    protected static ?string $title = 'Pengadaan'; // Page title

    protected static ?string $slug = 'kebutuhan-buku';
    protected static ?string $navigationGroup = 'Admin Management';

    protected function getHeaderWidgets(): array
    {
        return [
                PengadaanWidget::class,
        ];
    }

    

}
