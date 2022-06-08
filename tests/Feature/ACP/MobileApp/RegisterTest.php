<?php

namespace Tests\Feature\ACP\MobileApp;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

class RegisterTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    protected $BASE_URL = 'api/merchant/';

    /**
     * For Test City API
     *
     * @return void
     */
    public function testMerchantRegister()
    {
        $faker = Faker::create();

        $data = [
            "email" => $faker->email(),
            "mobile" => $faker->phoneNumber(),
            "password" => $faker->password(),
            "shop_name" => $faker->name(),
            "name" => $faker->name(),
            "city" => 7,
            "region" => 7,
            "location" => null,
            "agree" => 1
        ];

        $response = $this->json('POST', $this->BASE_URL . 'register/request',$data);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

}
