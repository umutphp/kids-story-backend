<?php

namespace App\Filament\Resources\StoryResource\Pages;

use App\Filament\Resources\StoryResource;
use Filament\Resources\Pages\Page;

class ReadStory extends Page
{
    protected static string $resource = StoryResource::class;

    protected static string $view = 'filament.resources.story-resource.pages.read-story';
}
