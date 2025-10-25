<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::where('user_id', Auth::id())->get;

        return response()->json([
            'message' => "categories retrieved successfully",
            'data' => $category
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => Auth::id(),
            'name' => 'required|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'type' => $request->type
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::id();
        $category = Category::where('user_id', $user)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ], 201);
    }

    public function destroy($id)
    {
        $user = Auth::id();
        $category = Category::where('user_id', $user)->findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
