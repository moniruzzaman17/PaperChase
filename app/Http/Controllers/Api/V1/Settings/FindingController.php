<?php

namespace App\Http\Controllers\Api\V1\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finding;

class FindingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $findings = Finding::with('subTopic')->get();
        return response()->json($findings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'findings' => 'required|string|max:255',
            'sub_topic_id' => 'required|exists:sub_topics,id',
        ]);

        $finding = Finding::create($request->only('findings', 'sub_topic_id'));

        return response()->json(['message' => 'Finding created successfully', 'finding' => $finding], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $finding = Finding::with('subTopic')->findOrFail($id);
        return response()->json($finding);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $finding = Finding::findOrFail($id);
        $request->validate([
            'findings' => 'required|string|max:255',
            'sub_topic_id' => 'required|exists:sub_topics,id',
        ]);

        $finding->update($request->only('findings', 'sub_topic_id'));

        return response()->json(['message' => 'Finding updated successfully', 'finding' => $finding]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $finding = Finding::findOrFail($id);
        $finding->delete();

        return response()->json(['message' => 'Finding deleted successfully']);
    }
}
