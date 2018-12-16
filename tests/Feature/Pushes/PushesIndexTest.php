<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entity\Push;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PushesIndexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * List pushes
     *
     * @return void
     */
    public function testListPushesSuccess()
    {
        $pushes = factory(Push::class, 21)->create();
        $pushes->shift();
        $pushes = array_values($pushes->sortByDesc('id')->toArray());

        $response = $this->get('/api/gitlab/pushes');

        $result = $response
            ->assertStatus(200)
            ->decodeResponseJson();

        foreach($result as $key => $pushResult) {
            $this->assertEquals($pushes[$key]['id'], $pushResult['id']);
            $this->assertEquals($pushes[$key]['repository_name'], $pushResult['repository_name']);
        }
    }
}
