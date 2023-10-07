<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notes\NoteStoreRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use App\Http\Resources\NoteResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteUserController extends Controller
{
    public function index(User $user) : JsonResource
    {
        $notes = $user->notes;
        return NoteResource::collection($notes);
    }

    public function store(User $user, NoteStoreRequest $request) : JsonResponse
    {
        $notes = Note::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user->id
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Note Created',
            'data' => new NoteResource($notes)
        ], 201);
    }

    public function show(Note $note) : JsonResource
    {

        return new NoteResource($note);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
