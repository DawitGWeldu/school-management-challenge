<?php

namespace App\Filament\Resources\SubjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class GradesRelationManager extends RelationManager
{
    protected static string $relationship = 'grades';

    protected static ?string $title = 'Grades';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'first_name')
                    ->required()
                    ->preload()
                    ->searchable(['first_name', 'last_name', 'student_id'])
                    ->label('Student'),

                Forms\Components\Select::make('teacher_id')
                    ->relationship('teacher', 'first_name')
                    ->required()
                    ->preload()
                    ->searchable(['first_name', 'last_name', 'employee_id'])
                    ->label('Teacher'),

                Forms\Components\TextInput::make('marks')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.01),

                Forms\Components\TextInput::make('grade_letter')
                    ->maxLength(2),

                Forms\Components\Textarea::make('remarks')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\DatePicker::make('grading_date')
                    ->required()
                    ->maxDate(now())
                    ->default(now()),

                Forms\Components\TextInput::make('academic_term')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('academic_year')
                    ->required()
                    ->maxLength(255)
                    ->default(now()->year),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Student')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.full_name')
                    ->label('Teacher')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('marks')
                    ->numeric(2)
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade_letter')
                    ->searchable(),
                Tables\Columns\TextColumn::make('academic_term')
                    ->searchable(),
                Tables\Columns\TextColumn::make('academic_year')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grading_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('academic_year')
                    ->options(fn () => [
                        now()->year => now()->year,
                        now()->subYear()->year => now()->subYear()->year,
                        now()->subYears(2)->year => now()->subYears(2)->year,
                    ]),
                Tables\Filters\SelectFilter::make('academic_term')
                    ->options([
                        'Term 1' => 'Term 1',
                        'Term 2' => 'Term 2',
                        'Term 3' => 'Term 3',
                        'Term 4' => 'Term 4',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
} 