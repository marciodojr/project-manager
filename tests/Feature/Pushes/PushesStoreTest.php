<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entity\Push;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PushesStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * List pushes
     *
     * @return void
     */
    public function testStorePushesSuccess()
    {
        $push = factory(Push::class)->make();
        $response = $this->post('/api/gitlab/pushes', [
            'project' => [
                'name' => $push->repository_name
            ],
            'user_username' => $push->pusher,
            'total_commits_count' => $push->number_of_commits
        ]);

        $json = $response
            ->assertStatus(201)
            ->decodeResponseJson();

        $this->assertIsInt($json['id']);
        $this->assertDatabaseHas('pushes', $json);
    }
}
