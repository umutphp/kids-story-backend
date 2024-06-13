<?php

namespace App\Services;

use App\Models\StoryTrigger;

class PromptService
{
    public function getPrompt(StoryTrigger $storyTrigger)
    {
        if ($storyTrigger->parameters["lang"] == 'tr') {
            $header = "6 yaş altı çocuklar için uyumadan önce okunacak hikayeler yazmanı istiyorum. İlk satırda hikayenin adı olmalı ve ilk cümle 'Bir varmış, bir yokmuş.' olmalı.";
            $lang   = "Hikaye Türkçe olmalı. ";
            $topic  = "Hikayenin konusu " . $storyTrigger->parameters["topic"] . " olmalı. ";
            $place  = "Hikayenin geçtiği yer " . $storyTrigger->parameters["place"] . " olmalı. ";
            $chars  = "Hikayede aşağıdaki karakterler yer almnalı.\n";

            foreach ($storyTrigger->characters as $char) {
                $chars .= AnimalService::turkishForFilament()[strtolower($char["kind"])]?? $char["kind"];
                $chars .= " olan " .  $char["name"] . ".\n";
            }

            $footer = "";
        } else {
            $header = "I want you to create a bedtime story for the kids under 6 age. First line should be the title. The story should start with 'Once upon a time' after title.";
            $lang   = "It should be in English.";
            $topic  = "The story should be about " . $storyTrigger->parameters["topic"] . ".";
            $place  = "The story should take place in a " . $storyTrigger->parameters["place"] . ".";
            $chars  = "The story should have the following characters.\n";

            foreach ($storyTrigger->characters as $char) {
                $chars .= $char["name"] . " is a " . $char["kind"] . ".\n";
            }

            $footer = "";
        }
        
        return $header . $lang . $topic . $place. $chars . $footer;
    }
}
