<?php

namespace Tests\Feature\ACP\Merchant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class InvoiceTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * For Test Invoice View
     *
     * @return void
     */
    public function testInvoice()
    {
        $merchant = User::select("users.*","shops.name as shop_name")->join("shops","shops.owner_id","users.id")->first();
        $this->withSession(['merchant_id' => $merchant->id]);
        $this->get(route('merchant.invoices'))
            ->assertStatus(200);
    }
}
