<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entity\Push;

class PushesIndexTest extends TestCase
{
    /**
     * List pushes
     *
     * @return void
     */
    public function testListPushesSuccess()
    {

        $pushes = Push::orderBy('id', 'desc')->limit(20)->get()->toArray();

        $response = $this->get('/api/gitlab/pushes');
        $response
            ->assertStatus(200)
            ->assertExactJson($pushes);
    }
}
