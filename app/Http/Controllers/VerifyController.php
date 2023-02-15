<?php

namespace App\Http\Controllers;

use App\Rules\MinDigit;
use App\Rules\MinLowercase;
use App\Rules\MinSpecialChars;
use App\Rules\MinUppercase;
use App\Rules\NoRepeated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $requestRules = $request->rules;

        foreach ($requestRules as $key => $rule) {
            switch ($rule['rule']) {
                case 'minSize':
                    $allRules[] = "min:{$rule['value']}";
                    break;
                case 'minUppercase':
                    $allRules[] = new MinUppercase($rule['value']);
                    break;
                case 'minLowercase':
                    $allRules[] = new MinLowercase($rule['value']);
                    break;
                case 'minDigit':
                    $allRules[] = new MinDigit($rule['value']);
                    break;
                case 'minSpecialChars':
                    $allRules[] = new MinSpecialChars($rule['value']);
                    break;
                case 'noRepeated':
                    $allRules[] = 'not_regex:/(.)\1{1,}/';
                    break;                    
            }
        }

        $validator = Validator::make($request->all(), [
            'password' => $allRules
        ], [
            'not_regex'   =>  'noRepeated',
        ]
        );

        $status = $validator->fails();

        return response()->json(
            ['verify' => !$status, 'noMatch' => $validator->errors()->get('password')],
            !$status ? 200 : 400
        );
    }
}