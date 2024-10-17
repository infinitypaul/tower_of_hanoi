<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TowerOfHanoiTest extends TestCase
{

    public function testInitialState()
    {
        $response =  $this->getJson('/api/state');

        $response->assertStatus(200);

        $response->assertJson([
            'pegs' => [
                [7, 6, 5, 4, 3, 2, 1],
                [],
                []
            ],
            'gameOver' => false,
        ]);
    }

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

    public function testGameOver()
    {
        $moves = $this->generateMoves(7, 1, 3, 2);

        foreach ($moves as $move) {
            $this->postJson("/api/move/{$move[0]}/{$move[1]}");
        }

        $response = $this->postJson('/api/move/1/2');

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Game Over'
        ]);
    }

    private function generateMoves($disks, $source, $destination, $aux)
    {
        $moves = [];

        if ($disks == 1) {
            $moves[] = [$source, $destination];
        } else {
            $moves = array_merge($moves, $this->generateMoves($disks - 1, $source, $aux, $destination));

            $moves[] = [$source, $destination];

            $moves = array_merge($moves, $this->generateMoves($disks - 1, $aux, $destination, $source));
        }

        return $moves;
    }

    public function testMoveFromEmptyPeg()
    {
        $response = $this->postJson('/api/move/3/2');

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Invalid Move'
        ]);
    }

}
