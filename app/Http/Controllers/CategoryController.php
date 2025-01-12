<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255|unique:categories',
            'description' => 'nullable',
        ]);

        try {

            Category::create($request->all());
            return response()->json(["Success" => "Category created successfully"], 200);

        } catch(Exception $e) {

            return response()->json(["Error" => $e->getMessage()], 500);
        }
    }

    function delete(Category $category) {
        $category->delete();
        return redirect()->route('settings')->with('success', 'Category deleted successfully.');
    }
}
