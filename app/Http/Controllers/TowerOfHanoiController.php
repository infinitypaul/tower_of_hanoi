<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TowerOfHanoiController extends Controller
{

    private array $pegs;
    private int $totalDisks = 7;

    private bool $gameOver = false;
    public function __construct()
    {
        $this->pegs = [
            range($this->totalDisks, 1),
            [],
            []
        ];
    }

    public function getState()
    {
        return response()->json([
            'pegs' => $this->pegs,
            'gameOver' => $this->gameOver
        ]);
    }

    public function move($from, $to)
    {
        if($this->gameOver) {
            return response()->json([
                'message' => 'Game Over'
            ], 400);
        }

        $source = $from - 1;
        $destination = $to - 1;

        if(!$this->isValidMove($source, $destination)) {
            return response()->json([
                'message' => 'Invalid Move'
            ], 400);
        }

        $disk = array_pop($this->pegs[$source]);
        $this->pegs[$destination][] = $disk;

        if(count($this->pegs[2]) === $this->totalDisks) {
            $this->gameOver = true;
            return response()->json([
                'message' => 'Game Over'
            ], 200);
        }

        return  $this->getState();

    }

    private function isValidMove($source, $destination)
    {
        if(empty($this->pegs[$source])) {
            return false;
        }

        if(empty($this->pegs[$destination])) {
            return true;
        }

        return end($this->pegs[$source]) < end($this->pegs[$destination]);
    }
}
