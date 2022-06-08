<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Group;
use App\Models\SubGroup;
use Faker\Factory as Faker;

class CategoryTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For Test Category By Group
     *
     * @return void
     */
    public function testCategoryByGroup()
    {
        $group = Group::first();
        $this->get(route('superadmin.categories.show',[$group->id,"group"]))
            ->assertStatus(200);
    }

    /**
     * For Test Category By Sub Group
     *
     * @return void
     */
    public function testCategoryBySubGroup()
    {
        $subgroup = SubGroup::first();
        $this->get(route('superadmin.categories.show',[$subgroup->id,"subgroup"]))
            ->assertStatus(200);
    }


    /**
     * For Test Store Category
     *
     * @return void
     */
    public function testStoreCategory()
    {
        $faker = Faker::create();
        $category_data = Group::select('tbl_acp_groups.id as group_id','tbl_acp_subgroup.id as sub_group_id')
        ->join('tbl_acp_subgroup','tbl_acp_subgroup.group_id', 'tbl_acp_groups.id')
        ->first();

        $data = [
            "category_name" => $faker->name(),
            "group_id" => $category_data->group_id,
            "sub_group_id" => $category_data->sub_group_id
        ];

        $this->post(route('superadmin.categories.store'),$data)
            ->assertStatus(302);
    }


}
