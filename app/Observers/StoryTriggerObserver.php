<?php

namespace App\Observers;

use App\Jobs\GenerateStoryJob;
use App\Models\StoryTrigger;

class StoryTriggerObserver
{
    /**
     * Handle the StoryTrigger "created" event.
     */
    public function created(StoryTrigger $storyTrigger): void
    {
        GenerateStoryJob::dispatch($storyTrigger);
    }

    /**
     * Handle the StoryTrigger "updated" event.
     */
    public function updated(StoryTrigger $storyTrigger): void
    {
        if ($storyTrigger->status == 'new') {
            GenerateStoryJob::dispatch($storyTrigger);
        }
    }

    /**
     * Handle the StoryTrigger "deleted" event.
     */
    public function deleted(StoryTrigger $storyTrigger): void
    {
        //
    }

    /**
     * Handle the StoryTrigger "restored" event.
     */
    public function restored(StoryTrigger $storyTrigger): void
    {
        //
    }

    /**
     * Handle the StoryTrigger "force deleted" event.
     */
    public function forceDeleted(StoryTrigger $storyTrigger): void
    {
        //
    }
}
