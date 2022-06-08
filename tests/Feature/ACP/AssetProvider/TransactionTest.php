<?php

namespace Tests\Feature\ACP\AssetProvider;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AssetProvider;

class TransactionTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * For Test Transaction View
     *
     * @return void
     */
    public function testTransaction()
    {
        $asset_provider = AssetProvider::first();
        $this->withSession(['asset_provider_id' => $asset_provider->id]);
        $this->get(route('assetprovider.transactions'))
            ->assertStatus(200);
    }
}
