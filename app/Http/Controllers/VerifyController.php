<?php

namespace App\Http\Controllers;

use App\Rules\MinDigit;
use App\Rules\MinLowercase;
use App\Rules\MinSpecialChars;
use App\Rules\MinUppercase;
use Illuminate\Http\Request;
use App\Models\Verify;
use App\Http\Requests\VerifyRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        // evita letras repetidas seguidas
        $allRules = ['not_regex:/(.)\1{1,}/'];

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
            }
        }

        $validator = Validator::make($request->all(), [
            'password' => $allRules
        ]);

        return response()->json(
            ['verify' => !$validator->fails(), 'noMatch' => $validator->errors()->get('password')]
        );
    }
}