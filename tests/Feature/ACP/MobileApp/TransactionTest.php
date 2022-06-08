<?php

namespace Tests\Feature\ACP\MobileApp;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\MerchantAssetOrder;

class TransactionTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    protected $BASE_URL = 'api/merchant/';

    /**
     * For Test Transactions API
     *
     * @return void
     */
    public function testTransactions()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'transactions/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Transaction Details API
     *
     * @return void
     */
    public function testTransactionDetails()
    {
        $order = MerchantAssetOrder::where("status", "delivered")->first();
        if ($order) {
            $response = $this->json('GET', $this->BASE_URL . 'transactiondetails/' . $order->id);
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
     * For Test Payment Status API
     *
     * @return void
     */
    public function testPaymentStats()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $response = $this->json('GET', $this->BASE_URL . 'paymentstats/' . $merchant->id);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }

    /**
     * For Test Payment Confirmation API
     *
     * @return void
     */
    public function testPaymentConfirmation()
    {
        $merchant = User::select("users.*", "shops.name as shop_name")->join("shops", "shops.owner_id", "users.id")->first();
        $type = ["today", "pending", "over_due", "past_over_due", "defaulted"];
        $response = $this->json('GET', $this->BASE_URL . 'paymentconfirmation/' . $merchant->id . '/' . $type[random_int(0, 4)]);
        if ($response->getStatusCode() == 204) {
            $response->assertStatus(204);
        } else {
            $response->assertStatus(200);
        }
    }
}
