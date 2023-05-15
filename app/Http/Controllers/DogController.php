<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDogRequest;
use App\Jobs\DogStoringJob;
use App\Models\Dog;
use Illuminate\Http\JsonResponse;

class DogController extends Controller
{
    const DOG_LIMIT = 30;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $name = request()->query('name');
        $dogs = Dog::query();
        if (!is_null($name)) {
            $dogs = $dogs->where('name', $name);
        }
        $dogs = $dogs->limit(DogController::DOG_LIMIT)->get();
        return response()->json($dogs);
    }

    /**
     * Store a new dog.
     * @param StoreDogRequest $request
     * @return JsonResponse
     */
    public function store(StoreDogRequest $request): JsonResponse
    {
        $dogData = $request->only('name', 'data');
        DogStoringJob::dispatch($dogData);
        return response()->json($dogData);
    }
}
