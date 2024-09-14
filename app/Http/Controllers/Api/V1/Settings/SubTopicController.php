<?php

namespace App\Http\Controllers\Api\V1\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubTopic;

class SubTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subTopics = SubTopic::with('topic')->get();
        return response()->json($subTopics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
        ]);

        $subTopic = SubTopic::create($request->only('name', 'topic_id'));

        return response()->json(['message' => 'SubTopic created successfully', 'subTopic' => $subTopic], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subTopic = SubTopic::with('topic')->findOrFail($id);
        return response()->json($subTopic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subTopic = SubTopic::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
        ]);

        $subTopic->update($request->only('name', 'topic_id'));

        return response()->json(['message' => 'SubTopic updated successfully', 'subTopic' => $subTopic]);
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subTopic = SubTopic::findOrFail($id);
        $subTopic->delete();

        return response()->json(['message' => 'SubTopic deleted successfully']);
    }
}
