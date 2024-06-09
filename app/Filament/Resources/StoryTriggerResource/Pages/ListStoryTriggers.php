<?php

namespace App\Filament\Resources\StoryTriggerResource\Pages;

use App\Filament\Resources\StoryTriggerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoryTriggers extends ListRecords
{
    protected static string $resource = StoryTriggerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
