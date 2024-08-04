<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $category = Category::get();
            return response()->json([
                'message' => 'category retrieved successfully',
                'data' => $category,
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 500,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $category = Category::create($request->all());
            return response()->json(['message' => 'success creating data', 'data' => $category, 'status' => 201], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        try {
            if ($category) {
                return response()->json(['message' => 'success fetching data', 'data' => $category->with('products')->find($category->id), 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'Category not found', 'data' => null], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category->update($request->all());
            return response()->json(
                [
                    'message' => 'success modified data',
                    'data' => $category,
                    'status' => 202
                ],
                202
            );
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json(
                [
                    'message' => 'success deleted data',
                    'data' => null,
                    'status' => 200
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
