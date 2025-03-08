<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Academic Management';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Subject Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\Select::make('grade_level')
                            ->required()
                            ->options([
                                'Grade 1' => 'Grade 1',
                                'Grade 2' => 'Grade 2',
                                'Grade 3' => 'Grade 3',
                                'Grade 4' => 'Grade 4',
                                'Grade 5' => 'Grade 5',
                                'Grade 6' => 'Grade 6',
                                'Grade 7' => 'Grade 7',
                                'Grade 8' => 'Grade 8',
                                'Grade 9' => 'Grade 9',
                                'Grade 10' => 'Grade 10',
                                'Grade 11' => 'Grade 11',
                                'Grade 12' => 'Grade 12',
                            ])
                            ->searchable(),

                        Forms\Components\TextInput::make('credits')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(10)
                            ->default(1),

                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade_level')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('credits')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('grade_level')
                    ->options([
                        'Grade 1' => 'Grade 1',
                        'Grade 2' => 'Grade 2',
                        'Grade 3' => 'Grade 3',
                        'Grade 4' => 'Grade 4',
                        'Grade 5' => 'Grade 5',
                        'Grade 6' => 'Grade 6',
                        'Grade 7' => 'Grade 7',
                        'Grade 8' => 'Grade 8',
                        'Grade 9' => 'Grade 9',
                        'Grade 10' => 'Grade 10',
                        'Grade 11' => 'Grade 11',
                        'Grade 12' => 'Grade 12',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\GradesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
