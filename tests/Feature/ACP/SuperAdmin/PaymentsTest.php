<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For test asset provider view
     *
     * @return void
     */
    public function testPayments()
    {
        $this->get(route('superadmin.payments'))
            ->assertStatus(200);
    }
}
