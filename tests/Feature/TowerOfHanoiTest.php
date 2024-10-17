<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TowerOfHanoiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testValidMove(): void
    {
        $response = $this->postJson('/api/move/1/2');

        $response->assertStatus(200);

        $response->assertJson([
            'pegs' => [
                [7, 6, 5, 4, 3, 2],
                [1],
                []
            ],
            'gameOver' => false
        ]);
    }

    public function testInvalidMove()
    {
        $this->postJson('/api/move/1/2');

        $response = $this->postJson('/api/move/1/2');

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Invalid Move'
        ]);
    }
}
