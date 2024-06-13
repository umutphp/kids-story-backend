<?php

namespace App\Console\Commands;

use App\Services\StoryService;
use Illuminate\Console\Command;

class TestOpenAIModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openai:test-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the configured model.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $prompt = "6 yaş altı çocuklar için uyumadan önce okunacak hikayeler yazmanı istiyorum. İlk satırda hikayenin adı olmalı ve ilk cümle 'Bir varmış, bir yokmuş.' olmalı. " . 
        "Hikaye Türkçe olmalı. Hikayenin konusu kıskançlık olmalı.Hikayenin geçtiği yer tren istasyonu olmalı.Hikayede aşağıdaki karakterler yer almnalı." .
        "Tom adında Kedi" . PHP_EOL . 
        "Jerry adında Fare";
        $text   = StoryService::generateStoryText($prompt);
        
        $this->info("Prompt: " . $prompt);
        $this->info("Sonuç" . $text);
    }
}
