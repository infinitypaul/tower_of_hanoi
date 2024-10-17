<?php

namespace App\Services;

class TowerOfHanoiService
{
    private array $rods;
    private int $diskCount;
    private bool $isGameFinished = false;

    CONST GAME_OVER = 'Game Over';
    CONST INVALID_MOVE = 'Invalid Move';
    CONST MOVE_SUCCESSFUL = 'Move Successful';

    public function __construct(int $diskCount = 7)
    {
        $this->diskCount = $diskCount;
        $this->initializeGame();
    }


    /**
     * @return void
     */
    public function initializeGame(): void
    {
        $this->rods = [
            range($this->diskCount, 1),
            [],
            []
        ];
        $this->isGameFinished = false;
    }

    /**
     * @return array
     */
    public function fetchGameState(): array
    {
        return [
            'pegs' => $this->rods,
            'gameOver' => $this->isGameFinished
        ];
    }

    /**
     * @param int $startRod
     * @param int $targetRod
     * @return string
     */
    public function move(int $startRod, int $targetRod): string
    {
        if ($this->isGameFinished) {
            return self::GAME_OVER;
        }

        $start = $startRod - 1;
        $end = $targetRod - 1;

        if (!$this->validateMove($start, $end)) {
            return self::INVALID_MOVE;
        }


        $currentDisk = array_pop($this->rods[$start]);
        $this->rods[$end][] = $currentDisk;


        if (count($this->rods[2]) === $this->diskCount) {
            $this->isGameFinished = true;
            return self::GAME_OVER;
        }

        return self::MOVE_SUCCESSFUL;
    }

    /**
     * @param int $start
     * @param int $end
     * @return bool
     */
    private function validateMove(int $start, int $end): bool
    {
        if (empty($this->rods[$start])) {
            return false;
        }

        if (empty($this->rods[$end])) {
            return true;
        }

        return end($this->rods[$start]) < end($this->rods[$end]);
    }



}
