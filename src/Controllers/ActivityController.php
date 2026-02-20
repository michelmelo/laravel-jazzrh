<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\Activity;
use MichelMelo\JazzRh\Resources\ActivityResource;

class ActivityController extends Controller
{
    public function index(): JsonResponse
    {
        $activities = Activity::all();

        return response()->json(ActivityResource::collection($activities));
    }

    public function show(int $id): JsonResponse
    {
        $activity = Activity::find($id);
        if (! $activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        return response()->json(new ActivityResource($activity));
    }

    public function store(Request $request): JsonResponse
    {
        $activity = Activity::create($request->all());

        return response()->json(new ActivityResource($activity), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $activity = Activity::find($id);
        if (! $activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
        $activity->update($request->all());

        return response()->json(new ActivityResource($activity));
    }

    public function destroy(int $id): JsonResponse
    {
        $activity = Activity::find($id);
        if (! $activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
        $activity->delete();

        return response()->json(null, 204);
    }
}
