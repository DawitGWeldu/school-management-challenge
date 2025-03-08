<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\GradeResource\Pages;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Student Grades';

    protected static ?string $modelLabel = 'Grade';

    protected static ?string $pluralModelLabel = 'Grades';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Grade Details')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->relationship('student', 'first_name')
                            ->required()
                            ->preload()
                            ->searchable(['first_name', 'last_name', 'student_id'])
                            ->label('Student'),

                        Forms\Components\Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->required()
                            ->preload()
                            ->searchable(['name', 'code'])
                            ->label('Subject'),

                        Forms\Components\TextInput::make('marks')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01),

                        Forms\Components\TextInput::make('grade_letter')
                            ->maxLength(2),

                        Forms\Components\DatePicker::make('grading_date')
                            ->required()
                            ->maxDate(now())
                            ->default(now()),

                        Forms\Components\Select::make('academic_term')
                            ->required()
                            ->options([
                                'Term 1' => 'Term 1',
                                'Term 2' => 'Term 2',
                                'Term 3' => 'Term 3',
                                'Term 4' => 'Term 4',
                            ]),

                        Forms\Components\TextInput::make('academic_year')
                            ->required()
                            ->default(now()->year)
                            ->maxLength(4),

                        Forms\Components\Textarea::make('remarks')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Student')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->searchable()
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
                Tables\Filters\SelectFilter::make('subject_id')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Subject'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('teacher_id', auth()->user()->teacher->id)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
} 