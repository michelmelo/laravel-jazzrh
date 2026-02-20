<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\Applicants2Jobs;
use MichelMelo\JazzRh\Resources\Applicants2JobsResource;

class Applicants2JobsController extends Controller
{
    public function index(): JsonResponse
    {
        $items = Applicants2Jobs::all();
        return response()->json(Applicants2JobsResource::collection($items));
    }

    public function show(int $id): JsonResponse
    {
        $item = Applicants2Jobs::find($id);
        if (! $item) {
            return response()->json(['message' => 'Applicants2Jobs not found'], 404);
        }
        return response()->json(new Applicants2JobsResource($item));
    }

    public function store(Request $request): JsonResponse
    {
        $item = Applicants2Jobs::create($request->all());
        return response()->json(new Applicants2JobsResource($item), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $item = Applicants2Jobs::find($id);
        if (! $item) {
            return response()->json(['message' => 'Applicants2Jobs not found'], 404);
        }
        $item->update($request->all());
        return response()->json(new Applicants2JobsResource($item));
    }

    public function destroy(int $id): JsonResponse
    {
        $item = Applicants2Jobs::find($id);
        if (! $item) {
            return response()->json(['message' => 'Applicants2Jobs not found'], 404);
        }
        $item->delete();
        return response()->json(null, 204);
    }
}
