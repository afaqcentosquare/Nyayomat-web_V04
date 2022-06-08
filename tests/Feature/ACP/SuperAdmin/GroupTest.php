<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

class GroupTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * For test group view
     *
     * @return void
     */
    public function testGroup()
    {
        $this->get(route('superadmin.categories'))
            ->assertStatus(200);
        
    }


    /**
     * For test store group
     *
     * @return void
     */
    public function testStoreGroup()
    {
        $faker = Faker::create();

        $data = [
            "group_name" => $faker->name(),
            "status" => "active"
        ];

        $this->post(route('superadmin.group.store', $data))
            ->assertStatus(302);
    }
}
