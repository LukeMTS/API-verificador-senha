<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class MinLowercase implements InvokableRule
{
    private $minLowercase;

    public function __construct($minLowercase)
    {
        $this->minLowercase = $minLowercase;
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
        if (mb_strlen(preg_replace('![^a-z]+!', '', $value)) < $this->minLowercase)
        {
            $fail('The :attribute must be lowercase.');
        }
    }

    
}
