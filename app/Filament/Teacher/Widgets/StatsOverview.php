<?php

namespace App\Filament\Teacher\Widgets;

use App\Models\Grade;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $teacherId = auth()->user()->teacher->id;

        $totalGrades = Grade::where('teacher_id', $teacherId)->count();
        $averageGrade = Grade::where('teacher_id', $teacherId)->avg('marks');
        $totalStudents = Grade::where('teacher_id', $teacherId)
            ->distinct('student_id')
            ->count('student_id');

        return [
            Stat::make('Total Students', $totalStudents)
                ->description('Students you teach')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            
            Stat::make('Total Grades', $totalGrades)
                ->description('Grades recorded')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
            
            Stat::make('Average Grade', number_format($averageGrade ?? 0, 2) . '%')
                ->description('Overall average')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
} 