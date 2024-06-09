<?php

namespace App\Services;

use App\Repositories\StoryRepository;
use Illuminate\Support\Str;


class StoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StoryRepository $storyRepository)
    {
        //
    }

    public function getPublicStories()
    {
        return $this->storyRepository->getData(
            [
                'public' => 1
            ]
        );
    }

    public static function parseTitle($story)
    {
        $str = strtok($story->body, "\n");


        if ($str) {
            if (Str::startsWith(Str::ucfirst(Str::of($str)->trim()), 'Title:')) {
                return Str::replaceFirst('Title:', '', Str::ucfirst(Str::of($str)->trim()));
            }
        }
        
        return false;
    }
}
