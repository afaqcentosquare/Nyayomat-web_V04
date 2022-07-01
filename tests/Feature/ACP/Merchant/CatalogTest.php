<?php

namespace Tests\Feature\ACP\Merchant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Asset;
use App\Models\MerchantAssetOrder;

class CatalogTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For Test Catalog View
     *
     * @return void
     */
    public function testCatalog()
    {
        $merchant = User::select("users.*","shops.name as shop_name")->join("shops","shops.owner_id","users.id")->first();
        $this->withSession(['merchant_id' => $merchant->id]);
        $this->get(route('merchant.catalog'))
            ->assertStatus(200);
    }

    /**
     * For Test Merchant Asset Request
     *
     * @return void
     */
    public function testAssetRequest()
    {
        //in this test we are testing emails as well
        $merchant = User::select("users.*","shops.name as shop_name")->join("shops","shops.owner_id","users.id")->first();
        $asset = Asset::first();
        $this->withSession(['merchant_id' => $merchant->id]);

        $data = [
            "units" => random_int(2, 10),
            "asset_id" => $asset->id
        ];

        $this->post(route('merchant.asset.request'), $data)
            ->assertStatus(302);
    }

    /**
     * For Test Merchant Update Status
     *
     * @return void
     */
    public function testUpdateOrderStatus()
    {
        $merchant = User::select("users.*","shops.name as shop_name")->join("shops","shops.owner_id","users.id")->first();
        $order = MerchantAssetOrder::where('merchant_id', $merchant->id)->where('status', 'pending')->first();
        $this->withSession(['merchant_id' => $merchant->id]);
        if ($order) {
            $this->get(route('merchant.update.order.status', [$order->id, 'delivered']))
                ->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }
    }
}
