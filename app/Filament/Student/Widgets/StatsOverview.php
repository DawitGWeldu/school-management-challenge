<?php

namespace App\Filament\Student\Widgets;

use App\Models\Grade;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $studentId = auth()->user()->student->id;

        $totalGrades = Grade::where('student_id', $studentId)->count();
        $averageGrade = Grade::where('student_id', $studentId)->avg('marks');
        $highestGrade = Grade::where('student_id', $studentId)->max('marks');
        $lowestGrade = Grade::where('student_id', $studentId)->min('marks');

        return [
            Stat::make('Average Grade', number_format($averageGrade ?? 0, 2) . '%')
                ->description('Your overall average')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),
            
            Stat::make('Highest Grade', number_format($highestGrade ?? 0, 2) . '%')
                ->description('Your best performance')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
            
            Stat::make('Lowest Grade', number_format($lowestGrade ?? 0, 2) . '%')
                ->description('Area for improvement')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('warning'),
            
            Stat::make('Total Grades', $totalGrades)
                ->description('Number of grades recorded')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray'),
        ];
    }
} 