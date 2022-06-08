<?php

namespace Tests\Feature\ACP\MobileApp;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\MerchantTransaction;

class PayTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    protected $BASE_URL = 'api/merchant/';

    /**
     * For Test Pay All Invoices
     *
     * @return void
     */
    public function testPayAll()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $type = ["today", "pending", "over_due", "past_over_due", "defaulted"];
        $this->json('GET', $this->BASE_URL . 'pay/all/' . $merchant->id . '/' . $type[random_int(0, 4)])
            ->assertStatus(200);
    }


    /**
     * For Test Pay Single Invoice
     *
     * @return void
     */
    public function testPaySingle()
    {
        $invoice = MerchantTransaction::wherenull('paid_on')->first();
        $this->json('GET', $this->BASE_URL . 'pay/now/' . $invoice->id . '/' . $invoice->merchant_id)
            ->assertStatus(200);
    }


    /**
     * For Test Merchant Account Balance
     *
     * @return void
     */
    public function testMerchantAccountBalance()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $this->json('GET', $this->BASE_URL . 'accountbalance/' . $merchant->id)
            ->assertStatus(200);
    }

}
