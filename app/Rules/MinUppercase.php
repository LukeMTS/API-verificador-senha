<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class MinUppercase implements InvokableRule
{
    private $minDigits;

    public function __construct($minDigits)
    {
        $this->minDigits = $minDigits;
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
        if (mb_strlen(preg_replace('![^A-Z]+!', '', $value)) < $this->minDigits) {
            $fail('The :attribute must be uppercase.');
        }
    }
}