<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int | array
    {
        return 2;
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Student\Widgets\StatsOverview::class,
            \App\Filament\Student\Widgets\LatestGrades::class,
        ];
    }
} 