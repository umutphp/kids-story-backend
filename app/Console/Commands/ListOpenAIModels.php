<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenAI;

class ListOpenAIModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openai:list-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List the available OpenAI mıodels';

    /**
     * Execute the console command.
     */
    public function handle()
    {   $client   = OpenAI::client(config("services.openai.key"));
        $response = $client->models()->list();

        $response->object; // 'list'

        $this->line("Models");
        foreach ($response->data as $result) {
            $this->info(" " . $result->id);
        }
    }
}
