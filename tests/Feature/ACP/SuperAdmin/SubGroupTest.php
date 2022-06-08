<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Group;
use Faker\Factory as Faker;

class SubGroupTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For Test Sub Group View
     *
     * @return void
     */
    public function testSubGroup()
    {
        $group = Group::first();
        $this->get(route('superadmin.subgroup.view',$group->id))
            ->assertStatus(200);
    }

    /**
     * For Test Store Sub Group
     *
     * @return void
     */
    public function testStoreSubGroup()
    {
        $group = Group::first();
        $faker = Faker::create();
        $data = [
            "sub_group_name" => $faker->name(),
            "status" => "active",
            "group_id" => $group->id
        ];
        $this->post(route('superadmin.subgroup.store'),$data)
            ->assertStatus(302);
    }
}