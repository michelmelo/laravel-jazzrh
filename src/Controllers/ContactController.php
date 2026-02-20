<?php

namespace MichelMelo\JazzRh\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use MichelMelo\JazzRh\Models\Contact;
use MichelMelo\JazzRh\Resources\ContactResource;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(): JsonResponse
    {
        $contacts = Contact::all();
        return response()->json(ContactResource::collection($contacts));
    }

    public function show(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        return response()->json(new ContactResource($contact));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'applicant_id' => 'required|integer|exists:applicants,id',
        ]);
        $contact = Contact::create($data);
        return response()->json(new ContactResource($contact), 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'nullable|string|max:50',
            'applicant_id' => 'sometimes|integer|exists:applicants,id',
        ]);
        $contact->update($data);
        return response()->json(new ContactResource($contact));
    }

    public function destroy(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(null, 204);
    }
}
