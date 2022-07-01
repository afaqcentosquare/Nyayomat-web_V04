<?php

namespace Tests\Feature\ACP\AssetProvider;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AssetProvider;
use App\Models\Asset;

class ProductCatalogTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For test Product Catalog view
     *
     * @return void
     */
    public function testProductCatalog()
    {
        $asset_provider = AssetProvider::first();
        $this->withSession(['asset_provider_id' => $asset_provider->id]);
        $this->get(route('assetprovider.productcatalog'))
            ->assertStatus(200);
    }


    /**
     * For Test Product Update Status Single Asset Functionality
     *
     * @return void
     */
    public function testUpdateStatusSingle()
    {
        //in this test we are testing emails as well
        $asset_provider = AssetProvider::first();
        $asset = Asset::where('asset_provider_id',$asset_provider->id)->first();
        $this->withSession(['asset_provider_id' => $asset_provider->id]);
        $this->get(route('assetprovider.productcatalog.update.status', [$asset->id, 1]))
            ->assertStatus(302);
    }

    /**
     * For Test Product Update Status All Asset Functionality
     *
     * @return void
     */
    public function testUpdateStatusAll()
    {
        $asset_provider = AssetProvider::first();
        $this->withSession(['asset_provider_id' => $asset_provider->asset_provider_id]);
        $this->get(route('assetprovider.productcatalog.update.status', [$asset_provider->id, 0]))
            ->assertStatus(302);
    }


    /**
     * For Test Product Update Asset Stock Functionality
     *
     * @return void
     */
    public function testUpdateStock()
    {
        $asset_provider = AssetProvider::first();
        $this->withSession(['asset_provider_id' => $asset_provider->id]);
        $asset = Asset::where('asset_provider_id', $asset_provider->id)->first();
        $data = [
            "units" => random_int(10,50)
        ];
        $this->post(route('assetprovider.productcatalog.update.stock', $asset->id), $data)
            ->assertStatus(302);
    }
}
