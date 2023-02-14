<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class MinDigit implements InvokableRule
{
    private $minDigit;

    public function __construct($minDigit)
    {
        $this->minDigit = $minDigit;
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
        if(mb_strlen(preg_replace('![^0-9]+!', '', $value)) < $this->minDigit)
        {
            $fail('minDigit');
        }
    }
}
