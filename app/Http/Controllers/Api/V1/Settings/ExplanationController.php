<?php

namespace App\Http\Controllers\Api\V1\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Explanation;

class ExplanationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $explanations = Explanation::with('finding')->get();
        return response()->json($explanations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'details' => 'required|string',
            'finding_id' => 'required|exists:findings,id',
        ]);

        $explanation = Explanation::create($request->only('details', 'finding_id'));

        return response()->json(['message' => 'Explanation created successfully', 'explanation' => $explanation], 201);
   }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $explanation = Explanation::with('finding')->findOrFail($id);
        return response()->json($explanation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $explanation = Explanation::findOrFail($id);
        $request->validate([
            'details' => 'required|string',
            'finding_id' => 'required|exists:findings,id',
        ]);

        $explanation->update($request->only('details', 'finding_id'));

        return response()->json(['message' => 'Explanation updated successfully', 'explanation' => $explanation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $explanation = Explanation::findOrFail($id);
        $explanation->delete();

        return response()->json(['message' => 'Explanation deleted successfully']);
    }
}
