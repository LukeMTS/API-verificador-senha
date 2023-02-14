<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class MinSpecialChars implements InvokableRule
{
    private $minSpecialChars;

    public function __construct($minSpecialChars)
    {
        $this->minSpecialChars = $minSpecialChars;
    }
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (mb_strlen(preg_replace('/[^!@#$%^&*()-+\/{}\[\]"]/', '', $value)) < $this->minSpecialChars) {
            $fail('minSpecialChars');
        }
    }
}