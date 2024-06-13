<?php

namespace App\Services;

use App\Repositories\StoryRepository;
use Illuminate\Support\Str;
use LLPhant\Chat\OllamaChat;
use LLPhant\OllamaConfig;
use OpenAI;

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

    public static function generateStoryText($prompt)
    {
        $AI = env('AI_SERVICE', 'ollama');

        switch ($AI) {
            case 'ollama':
                $config        = new OllamaConfig();
                $config->model = config("services.ollama.default_model");
                $config->url   = "http://" . config("services.ollama.host") . "/api/"; // host.docker.internal:11434 for the ollama in the host
                $chat          = new OllamaChat($config);
                
                return $chat->generateText($prompt);
            case 'openai':
                $client = OpenAI::client(config("services.openai.key"));

                $result = $client->chat()->create([
                    'model' => "gpt-4o",
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);

                return $result->choices[0]->message->content;
        }
    }

    public static function parseTitle($story)
    {
        $str = strtok($story->body, "\n");


        if ($str) {
            // Title: Title text
            if (Str::startsWith(Str::ucfirst(Str::of($str)->trim()), 'Title:')) {
                return Str::replaceFirst('Title:', '', Str::ucfirst(Str::of($str)->trim()));
            }

            // # Title text
            if (Str::startsWith(Str::of($str)->trim(), '#')) {
                return Str::replace('#', '', Str::ucfirst(Str::of($str)->trim()));
            }

            // *Title text*
            if (Str::startsWith(Str::of($str)->trim(), '*')) {
                return Str::replace('*', '', Str::ucfirst(Str::of($str)->trim()));
            }

            // **Title text**
            if (Str::startsWith(Str::of($str)->trim(), '**')) {
                return Str::replace('**', '', Str::ucfirst(Str::of($str)->trim()));
            }

            // ***Title text***
            if (Str::startsWith(Str::of($str)->trim(), '***')) {
                return Str::replace('***', '', Str::ucfirst(Str::of($str)->trim()));
            }
        }
        
        return false;
    }
}
