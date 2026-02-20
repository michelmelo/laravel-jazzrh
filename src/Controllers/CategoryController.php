<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\Category;
use MichelMelo\JazzRh\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return response()->json(CategoryResource::collection($categories));
    }

    public function show(int $id): JsonResponse
    {
        $category = Category::find($id);
        if (! $category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json(new CategoryResource($category));
    }

    public function store(Request $request): JsonResponse
    {
        $category = Category::create($request->all());
        return response()->json(new CategoryResource($category), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $category = Category::find($id);
        if (! $category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->update($request->all());
        return response()->json(new CategoryResource($category));
    }

    public function destroy(int $id): JsonResponse
    {
        $category = Category::find($id);
        if (! $category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(null, 204);
    }
}
