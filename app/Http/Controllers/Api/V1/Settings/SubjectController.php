<?php

namespace App\Http\Controllers\Api\V1\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all()->map(function ($subject, $index) {
            $subject->formatted_id = sprintf('%03d', $subject->id); // Convert to 3-digit format
            return $subject;
        });
        
        return response()->json($subjects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $subject = Subject::create($request->only('name'));

        return response()->json(['message' => 'Subject created successfully', 'subject' => $subject], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->formatted_id = sprintf('%03d', $subject->id); // Convert to 3-digit format
        
        return response()->json($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);
        
        $subject->update($request->only('name'));

        return response()->json(['message' => 'Subject updated successfully', 'subject' => $subject]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
