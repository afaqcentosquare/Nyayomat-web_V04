<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetProviderTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For test asset provider view
     *
     * @return void
     */
    public function testAssetProvider()
    {
        $this->get(route('superadmin.assetprovider'))
            ->assertStatus(200);
    }
}
