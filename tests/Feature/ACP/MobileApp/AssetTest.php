<?php

namespace Tests\Feature\ACP\MobileApp;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Asset;
use App\Models\MerchantAssetOrder;

class AssetTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    protected $BASE_URL = 'api/merchant/';

    /**
     * For Test Asset Request API
     *
     * @return void
     */
    public function testAssetRequest()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $asset = Asset::first();
        $data = [
            "user_id" => $merchant->id,
            "asset_id" => $asset->id,
            "units" => random_int(1, 10)
        ];
        $response = $this->json('POST', $this->BASE_URL . 'assetrequest', $data);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Order Asset Status API
     *
     * @return void
     */
    public function testOrderAssetStatus()
    {
        $order = MerchantAssetOrder::where('status', 'pending')->first();

        if ($order) {
            $response = $this->json('GET', $this->BASE_URL . 'orderassetstatus/' . $order->id . '/' . $order->merchant_id . '/delivered');
            if ($response->getStatusCode() == 204) {
                $response->assertStatus(204);
            } else {
                $response->assertStatus(200);
            }
        } else {
            $this->assertTrue(true);
        }
    }


    /**
     * For Test My Assets API
     *
     * @return void
     */
    public function testMyAssets()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'myassets/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test On Going Assets API
     *
     * @return void
     */
    public function testOnGoingAssets()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'ongoingassetstats/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Defaulted Assets API
     *
     * @return void
     */
    public function testDefaultedAssets()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'defaultedassetstats/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Completed Assets API
     *
     * @return void
     */
    public function testCompletedAssets()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'completedassetstats/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }


    /**
     * For Test Completed Assets Detail API
     *
     * @return void
     */
    public function testCompletedAssetsDetail()
    {
        $order = MerchantAssetOrder::where("total_out_standing_amount", 0)->first();

        if ($order) {
            $response = $this->json('GET', $this->BASE_URL . 'completedassetdetails/' . $order->id);
            if ($response->getStatusCode() == 204) {
                $response->assertStatus(204);
            } else {
                $response->assertStatus(200);
            }
        } else {
            $this->assertTrue(true);
        }
    }
}
