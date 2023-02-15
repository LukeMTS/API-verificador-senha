<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidPasswordTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_if_validations_are_ok()
    {
        $response = $this->post(
            env('APP_API_URL') . '/verify',
            [
                "password" => "Senha123Test@!",
                "rules" => [
                    [
                        "rule" => "minSize",
                        "value" => 8
                    ],
                    [
                        "rule" => "minSpecialChars",
                        "value" => 2
                    ],
                    [
                        "rule" => "noRepeted",
                        "value" => 0
                    ],
                    [
                        "rule" => "minDigit",
                        "value" => 3
                    ],
                    [
                        "rule" => "minUppercase",
                        "value" => 2
                    ],
                    [
                        "rule" => "minLowercase",
                        "value" => 2
                    ]
                ]
            ],
        );

        $response->assertStatus(200);
    }
}