<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\QuestionnaireAnswer;
use MichelMelo\JazzRh\Resources\QuestionnaireAnswerResource;
use Illuminate\Http\Request;

class QuestionnaireAnswerController extends Controller
{
    public function index(): JsonResponse
    {
        $answers = QuestionnaireAnswer::all();
        return response()->json(QuestionnaireAnswerResource::collection($answers));
    }

    public function show(int $id): JsonResponse
    {
        $answer = QuestionnaireAnswer::findOrFail($id);
        return response()->json(new QuestionnaireAnswerResource($answer));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'question_id' => 'required|integer|exists:questionnaire_questions,id',
            'applicant_id' => 'required|integer|exists:applicants,id',
            'answer' => 'required|string',
        ]);
        $answer = QuestionnaireAnswer::create($data);
        return response()->json(new QuestionnaireAnswerResource($answer), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $answer = QuestionnaireAnswer::findOrFail($id);
        $data = $request->validate([
            'question_id' => 'sometimes|integer|exists:questionnaire_questions,id',
            'applicant_id' => 'sometimes|integer|exists:applicants,id',
            'answer' => 'sometimes|string',
        ]);
        $answer->update($data);
        return response()->json(new QuestionnaireAnswerResource($answer));
    }

    public function destroy(int $id): JsonResponse
    {
        $answer = QuestionnaireAnswer::findOrFail($id);
        $answer->delete();
        return response()->json(null, 204);
    }
}
