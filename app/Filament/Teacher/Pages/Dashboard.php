<?php

namespace App\Filament\Teacher\Pages;

use App\Models\Grade;
use App\Models\Student;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int | array
    {
        return 2;
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Teacher\Widgets\StatsOverview::class,
            \App\Filament\Teacher\Widgets\LatestGrades::class,
        ];
    }
} 