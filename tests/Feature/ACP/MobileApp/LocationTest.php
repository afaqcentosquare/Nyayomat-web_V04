<?php

namespace Tests\Feature\ACP\MobileApp;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\City;
use App\Region;
use App\Location;

class LocationTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    protected $BASE_URL = 'api/merchant/';

    /**
     * For Test City API
     *
     * @return void
     */
    public function testCity()
    {
        $response = $this->json('GET', $this->BASE_URL . 'city');
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Region API
     *
     * @return void
     */
    public function testRegion()
    {
        $city = City::first();
        $response = $this->json('GET', $this->BASE_URL . 'region/' . $city->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }


    /**
     * For Test Location API
     *
     * @return void
     */
    public function testLocation()
    {
        $region = Region::first();
        $response = $this->json('GET', $this->BASE_URL . 'location/' . $region->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }
}
