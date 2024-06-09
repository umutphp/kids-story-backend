<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Models\Story;
use App\Services\StoryService;

class StoryController extends Controller
{
    public function __construct(private StoryService $storyService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = $this->storyService->getPublicStories();

        return view('stories.index', ['stories' => $stories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {   
        return view('stories.show', ['story' => $story]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoryRequest $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Story $story)
    {
        //
    }
}
