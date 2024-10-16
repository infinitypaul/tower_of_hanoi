<?php

namespace Tests\Unit;



use Tests\TestCase;

class TowerOfHanoiControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testInitialState()
    {
        $response =  $this->getJson('/api/state');

        $response->assertStatus(200);

        $response->assertJson([
            'pegs' => [
                [7, 1],
                [],
                []
            ],
            'gameOver' => false,
        ]);
    }
}
