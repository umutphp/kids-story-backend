<?php

namespace App\Services;

use App\Models\StoryTrigger;

class PromptService
{
    private $_lang;
    /**
     * Create a new class instance.
     */
    public function __construct($lang = 'en')
    {
        $this->_lang = $lang;
    }

    public function getPrompt(StoryTrigger $storyTrigger)
    {
        $header = "I want you to create a bedtime story for the kids under 6 age. First line should be the title. The story should start with 'Once upon a time' after title.";
        $lang   = "It should be in English.";

        if ($this->_lang == 'tr') {
            $lang   = "It should be in Turkish.";
        }

        $topic = "The story should be about " . $storyTrigger->parameters["topic"] . ".";

        $place = "The story should take place in a " . $storyTrigger->parameters["place"] . ".";

        $chars = "The story should have the following characters.\n";

        foreach ($storyTrigger->characters as $char) {
            $chars .= $char["name"] . " is a " . $char["kind"] . ".\n";
        }

        $footer = "";

        return $header . $lang . $topic . $place. $chars . $footer;
    }
}
