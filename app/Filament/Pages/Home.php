<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\BukuWidget;
use App\Filament\Widgets\BukuPenerbitWidget;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.home';

    protected static ?string $navigationLabel = 'Home'; // Navigation label
    protected static ?string $title = 'Home'; // Page title

    protected static ?string $slug = 'home';

    protected function getHeaderWidgets(): array
    {
        return [
                BukuPenerbitWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            BukuWidget::class,
        ];
    }
}
