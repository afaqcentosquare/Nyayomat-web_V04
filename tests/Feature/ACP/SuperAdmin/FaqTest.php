<?php

namespace Tests\Feature\ACP\SuperAdmin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use App\Models\Faq;
use App\Models\FaqTopic;

class FaqTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * For Test Faq View
     *
     * @return void
     */
    public function testFaq()
    {
        $this->get(route('superadmin.faqs'))
            ->assertStatus(200);
    }


    /**
     * For Test Store Topic Faq
     *
     * @return void
     */
    public function testStoreTopicFaq()
    {
        $faker = Faker::create();

        $topic_group = ["Customer", "Merchant", "Asset Provider"];

        $data = [
            "topic_name" => $faker->name(),
            "target_group" => $topic_group[random_int(0, 2)]
        ];

        $this->post(route('superadmin.faqs.topic.store'), $data)
            ->assertStatus(302);
    }

    /**
     * For Test Update Topic Faq
     *
     * @return void
     */
    public function testUpdateTopicFaq()
    {
        $faker = Faker::create();

        $faq_topic = FaqTopic::first();

        if ($faq_topic) {
            $topic_group = ["Customer", 'Merchant', 'Asset Provider'];

            $data = [
                "topic_name" => $faker->name(),
                "target_group" => $topic_group[random_int(0, 2)]
            ];

            $this->post(route('superadmin.faqs.topic.update', $faq_topic->id), $data)
                ->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }
    }

    /**
     * For Test Store Faq
     *
     * @return void
     */
    public function testStoreFaq()
    {
        $faker = Faker::create();

        $faq_topic = FaqTopic::first();

        if ($faq_topic) {
            $data = [
                "topic_id" => $faq_topic->topic_id,
                "question" => $faker->sentence(2),
                "answer" => $faker->paragraph(6),
            ];

            $this->post(route('superadmin.faqs.store'), $data)
                ->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }
    }

    /**
     * For Test Update Faq
     *
     * @return void
     */
    public function testUpdateFaq()
    {
        $faker = Faker::create();
        $faq = Faq::first();

        if ($faq) {
            $data = [
                "topic_id" => $faq->topic_id,
                "question" => $faker->sentence(2),
                "answer" => $faker->paragraph(6)
            ];

            $this->post(route('superadmin.faqs.update', $faq->id), $data)
                ->assertStatus(302);
        } else {
            $this->assertTrue(true);
        }
    }
}
