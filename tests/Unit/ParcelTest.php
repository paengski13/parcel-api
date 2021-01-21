<?php

namespace Tests\Unit;

use Tests\TestCase;

class ParcelTest extends TestCase
{

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_create_parcel_request()
    {
        $uniqueEmail = 'rafaeltorres0307+' . date('ymdhis') . rand(1000, 9999) . '@gmail.com';
        $password = 'courier123';
        // Register user
        $response = $this->postJson('api/register', [
            'name' => 'Rafael',
            'email' => $uniqueEmail,
            'password' => $password,
        ]);
        $response->assertStatus(200);

        // Login
        $response = $this->postJson('api/login', [
            'email' => $uniqueEmail,
            'password' => $password,
        ]);
        $response->assertStatus(200);

        $token = $response->json()['token'];
        $headers = [
            'Accept' => "application/json",
            'Authorization' => "Bearer " . $token,
        ];


        // Create a parcel
        $response = $this->postJson('api/parcels',[
            'name' => "New smartphone",
            'description' => "A box with a new smartphone",
            'standards' => [
                [
                    'model' => "weight",
                    'value' => 0.4,
                ],
                [
                    'model' => "volume",
                    'value' => 0.00079,
                ],
                [
                    'model' => "value",
                    'value' => 1300,
                ]
            ]
        ], $headers);

        $response->assertStatus(200);
    }

}
