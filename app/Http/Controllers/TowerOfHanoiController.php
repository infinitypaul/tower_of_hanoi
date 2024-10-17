<?php

namespace App\Http\Controllers;

use App\Services\TowerOfHanoiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TowerOfHanoiController extends Controller
{
    /**
     * @param TowerOfHanoiService $hanoiService
     */
    public function __construct(public TowerOfHanoiService $hanoiService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function getState()
    {
        return response()->json(
            $this->hanoiService->fetchGameState()
        );

    }

    /**
     * @param $from
     * @param $to
     * @return JsonResponse
     */
    public function move($from, $to)
    {
        $result = $this->hanoiService->move($from, $to);

        if ($result === TowerOfHanoiService::GAME_OVER || $result === TowerOfHanoiService::INVALID_MOVE) {
            return response()->json(['message' => $result], 400);
        }

        return response()->json($this->hanoiService->fetchGameState());

    }
}
