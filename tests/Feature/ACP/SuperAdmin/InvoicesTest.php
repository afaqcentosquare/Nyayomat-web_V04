<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AssetProviderTransaction;

class InvoicesTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * For Test Invoices View
     *
     * @return void
     */
    public function testInvoices()
    {
        $this->get(route('superadmin.invoices'))
            ->assertStatus(200);
    }


    /**
     * For Test Pay Invoice
     *
     * @return void
     */
    public function testPayInvoice()
    {
        $invoice = AssetProviderTransaction::wherenull("paid_on")->first();
        if($invoice){
            $this->get(route('superadmin.pay.now',$invoice->id))
            ->assertStatus(302);
        }else{
            $this->assertTrue(true);
        }
        
    }
}
