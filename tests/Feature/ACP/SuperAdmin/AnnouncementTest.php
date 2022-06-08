<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

class AnnouncementTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * For Test Announcement View
     *
     * @return void
     */
    public function testAnnouncement()
    {
        $this->get(route('superadmin.announcements'))
            ->assertStatus(200);
        
    }


    /**
     * For Test Store Announcement
     *
     * @return void
     */
    public function testStoreAnnouncement()
    {
        $faker = Faker::create();
        $topic_group = ["Customer", 'Merchant', 'Asset Provider'];
        $data = [
            "target_group" => $topic_group[random_int(0, 2)],
            "title" => $faker->title(),
            "body" => $faker->paragraph(2),
        ];

        $this->post(route('superadmin.announcement.store', $data))
            ->assertStatus(302);
    }
}
