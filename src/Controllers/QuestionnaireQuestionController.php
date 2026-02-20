<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\QuestionnaireQuestion;
use MichelMelo\JazzRh\Resources\QuestionnaireQuestionResource;
use Illuminate\Http\Request;

class QuestionnaireQuestionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = QuestionnaireQuestion::query();
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        $questions = $query->get();
        return response()->json(QuestionnaireQuestionResource::collection($questions));
    }

    public function show(int $id): JsonResponse
    {
        $question = QuestionnaireQuestion::findOrFail($id);
        return response()->json(new QuestionnaireQuestionResource($question));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'question' => 'required|string',
            'type' => 'required|string',
            'options' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_required' => 'nullable|boolean',
            'status' => 'nullable|string',
        ]);
        $question = QuestionnaireQuestion::create($data);
        return response()->json(new QuestionnaireQuestionResource($question), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $question = QuestionnaireQuestion::findOrFail($id);
        $data = $request->validate([
            'question' => 'sometimes|string',
            'type' => 'sometimes|string',
            'options' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_required' => 'nullable|boolean',
            'status' => 'nullable|string',
        ]);
        $question->update($data);
        return response()->json(new QuestionnaireQuestionResource($question));
    }

    public function destroy(int $id): JsonResponse
    {
        $question = QuestionnaireQuestion::findOrFail($id);
        $question->delete();
        return response()->json(null, 204);
    }
}
