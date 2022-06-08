<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PerformanceTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For Test Performance View
     *
     * @return void
     */
    public function testPerformance()
    {
        $this->get(route('superadmin.performance'))
            ->assertStatus(200);
    }

}
