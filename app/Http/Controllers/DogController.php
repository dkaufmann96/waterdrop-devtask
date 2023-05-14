<?php

namespace App\Http\Controllers;

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
}
