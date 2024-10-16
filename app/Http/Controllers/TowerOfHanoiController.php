<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TowerOfHanoiController extends Controller
{

    private $pegs;
    private int $totalDisks = 7;

    private bool $gameOver = false;
    public function __construct()
    {
        $this->pegs = [
            [$this->totalDisks, 1],
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
}
