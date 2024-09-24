<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WordCount implements Rule
{
    protected $min;
    protected $max;

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function passes($attribute, $value)
    {
        // Count the number of words
        $wordCount = str_word_count($value);

        // Ensure word count is between min and max
        return $wordCount >= $this->min && $wordCount <= $this->max;
    }

    public function message()
    {
        return "The :attribute must be between {$this->min} and {$this->max} words.";
    }
}
