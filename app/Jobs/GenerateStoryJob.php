<?php

namespace App\Jobs;

use App\Models\Story;
use App\Models\StoryTrigger;
use App\Services\PromptService;
use App\Services\StoryService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LLPhant\Chat\OllamaChat;
use LLPhant\OllamaConfig;

class GenerateStoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
    public $uniqueFor = 3600;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 3600;

    /**
     * Create a new job instance.
     */
    public function __construct(public StoryTrigger $storyTrigger)
    {
        //
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return $this->storyTrigger->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = new PromptService($this->storyTrigger->parameters["lang"]?? "en");

        $this->storyTrigger->status = 'pending';
        $this->storyTrigger->generation_started_at = Carbon::now();
        $this->storyTrigger->save();

        $prompt        = $service->getPrompt($this->storyTrigger);
        $config        = new OllamaConfig();
        $config->model = 'llama2';
        $config->url   = "http://host.docker.internal:11434/api/";
        $chat          = new OllamaChat($config);
        $text          = $chat->generateText($prompt);

        $story             = new Story();
        $story->title      = "Title to be parsed";
        $story->body       = $text;
        $story->characters = $this->storyTrigger->characters;

        $parsed = StoryService::parseTitle($story);

        if ($parsed) {
            $story->title = $parsed;

            $story->body =  substr($story->body, strpos($story->body, "\n") + 1);
        }

        $story->save();

        $this->storyTrigger->status = 'generated';
        $this->storyTrigger->generation_finished_at = Carbon::now();
        $this->storyTrigger->save();
    }
}
