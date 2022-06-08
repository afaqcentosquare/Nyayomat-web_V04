<?php

namespace Tests\Feature\ACP\AssetProvider;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AssetProvider;

class DashboardTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For test Asset Provider Dashboard
     *
     * @return void
     */
    public function testDashboard()
    {
        $asset_provider = AssetProvider::first();
        $this->withSession(['asset_provider_id' => $asset_provider->id]);
        $this->get(route('assetprovider.dashboard'))
            ->assertStatus(200);
    }
}
