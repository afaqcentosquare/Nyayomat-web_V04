<?php

namespace Tests\Feature\ACP\MobileApp;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ProductCatalogTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    protected $BASE_URL = 'api/merchant/';

    /**
     * For Test Catalog API
     *
     * @return void
     */
    public function testCatalog()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'catalog/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Browse API
     *
     * @return void
     */
    public function testBrowse()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'browse/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }


    /**
     * For Test Requested API
     *
     * @return void
     */
    public function testRequested()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'requested/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Received API
     *
     * @return void
     */
    public function testReceived()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'received/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }
}
