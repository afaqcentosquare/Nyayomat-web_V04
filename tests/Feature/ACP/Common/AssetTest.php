<?php

namespace Tests\Feature\ACP\Common;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AssetProvider;
use App\Models\Asset;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Category;

class AssetTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    
    /**
     * For test Store Asset Type "A"
     *
     * @return void
     */
    public function testATypeAsset()
    {
       //in this test we are testing emails as well
        $faker = Faker::create();
        $image = $faker->numerify('##########').'.png';
        $file = UploadedFile::fake()->create($image);

        $asset_provider = AssetProvider::first();

        $holiday_info = [
            "Daily",
            "Weekly",
            "Monthly"
        ];

        $category_data = Group::select('tbl_acp_groups.id as group_id','tbl_acp_subgroup.id as sub_group_id', 'tbl_acp_categories.id as category_id')
        ->join('tbl_acp_subgroup','tbl_acp_subgroup.group_id', 'tbl_acp_groups.id')
        ->join('tbl_acp_categories','tbl_acp_categories.sub_group_id','tbl_acp_subgroup.id')
        ->first();

        $data = [
            "asset_name" => $faker->name(),
            "units" => random_int(1,100),
            "unit_cost" => random_int(50,500),
            "holiday_provision" => random_int(0,30),
            "deposit_amount" => random_int(1,100),
            "installment" => random_int(1,10),
            "payment_frequency" => $holiday_info[random_int(0,2)],
            "payment_method" => "Mpesa",
            "group_id" => $category_data->group_id,
            "sub_group_id" => $category_data->sub_group_id,
            "category_id" => $category_data->category_id,
            'image' => $file,
            'asset_provider_id' => $asset_provider->id,
        ];
        
        $this->post(route('superadmin.asset.store'), $data)
            ->assertStatus(302);
    }

    /**
     * For test Store Asset Type "B"
     *
     * @return void
     */
    public function testBTypeAsset()
    {
       
        $asset_provider = AssetProvider::first();
        $asset = Asset::where('asset_provider_id', $asset_provider->id)->first();

        $holiday_info = [
            "Daily",
            "Weekly",
            "Monthly"
        ];

        $data = [
            "asset_name" => $asset->asset_name,
            "units" => random_int(1,100),
            "unit_cost" => random_int(50,500),
            "holiday_provision" => random_int(0,30),
            "deposit_amount" => random_int(1,100),
            "installment" => random_int(1,10),
            "payment_frequency" => $holiday_info[random_int(0,2)],
            "payment_method" => "Mpesa"
        ];
        
        $this->post(route('superadmin.asset.update',$asset_provider->id), $data)
            ->assertStatus(302);
    }



}
