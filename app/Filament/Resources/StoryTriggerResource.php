<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoryTriggerResource\Pages;
use App\Filament\Resources\StoryTriggerResource\RelationManagers;
use App\Models\StoryTrigger;
use App\Services\AnimalService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoryTriggerResource extends Resource
{
    protected static ?string $model = StoryTrigger::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $animals = AnimalService::allForFilament();
        return $form
            ->schema([
                Forms\Components\Repeater::make('characters')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\Select::make('kind')
                            ->options($animals)
                            ->searchable()
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\KeyValue::make('parameters')
                ->editableKeys(false)
                ->addable(false)
                ->default([
                    'lang' => 'en',
                    'place' => '',
                    'topic' => ''
                ]),
                Forms\Components\Radio::make('status')
                    ->options([
                        'new' => 'New',
                        'pending' => 'Pending',
                        'generated' => 'Generated'
                    ])
                    ->default('new')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('generation_started_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('generation_finished_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoryTriggers::route('/'),
            'create' => Pages\CreateStoryTrigger::route('/create'),
            'edit' => Pages\EditStoryTrigger::route('/{record}/edit'),
        ];
    }
}
