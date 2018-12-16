<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entity\Push;

class PushesStoreTest extends TestCase
{
    /**
     * List pushes
     *
     * @return void
     */
    public function testStorePushesSuccess()
    {
        $push = factory(Push::class)->create();
        $response = $this->post('/api/gitlab/pushes', [
            'repository' => [
                'name' => $push->repository_name
            ],
            'user_username' => $push->pusher,
            'total_commits_count' => $push->number_of_commits
        ]);
        $json = $response
            ->assertStatus(201)
            ->decodeResponseJson();

        $this->assertEquals($push->repository_name, $json['repository_name']);
        $this->assertEquals($push->pusher, $json['pusher']);
        $this->assertEquals($push->number_of_commits, $json['number_of_commits']);
        $this->assertIsInt($json['id']);
    }
}
