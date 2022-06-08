<?php

namespace Tests\Feature\ACP\Merchant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class DashboardTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For Test Merchant Dashboard View
     *
     * @return void
     */
    public function testDashboard()
    { 
        $merchant = User::select("users.*","shops.name as shop_name")->join("shops","shops.owner_id","users.id")->first();
        $this->withSession(['merchant_id' => $merchant->id]);
        $this->get(route('merchant.dashboard'))
            ->assertStatus(200);
    }
}
