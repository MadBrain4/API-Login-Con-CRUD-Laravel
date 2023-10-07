<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notes\NoteUpdateRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteController extends Controller
{
    public function index()
    {
        return NoteResource::collection(Note::all());
    }

    public function show(Note $note) : JsonResource
    {

        return new NoteResource($note);
    }

    public function update(NoteUpdateRequest $request, Note $note) : JsonResponse
    {
        $note->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Note Updated',
            'data' => new NoteResource($note)
        ]);
    }

    public function destroy(Note $note) : JsonResponse
    {
        $note->delete();

        return response()->json([
            'success' => true,
            'message' => 'Note Deleted',
            'data' => new NoteResource($note)
        ]);
    }
}
