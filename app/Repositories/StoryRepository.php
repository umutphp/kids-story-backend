<?php

namespace App\Repositories;

use App\Models\Story;


class StoryRepository
{
    use RepositoryBase;

    /**
     * Create a new class instance.
     */
    public function __construct(public Story $model)
    {
        //
    }
}
