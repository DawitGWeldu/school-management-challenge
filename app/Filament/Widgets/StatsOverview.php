<?php

namespace App\Filament\Widgets;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Active students in the system')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            
            Stat::make('Total Teachers', Teacher::count())
                ->description('Active teachers in the system')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
            
            Stat::make('Total Subjects', Subject::count())
                ->description('Available subjects')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('warning'),
            
            Stat::make('Total Grades', Grade::count())
                ->description('Grades recorded')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
            
            Stat::make('Average Grade', function () {
                $average = Grade::avg('marks');
                return number_format($average, 2) . '%';
            })
                ->description('Overall average')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
}
