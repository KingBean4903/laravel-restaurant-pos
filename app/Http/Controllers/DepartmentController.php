<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Department;

class DepartmentController extends Controller
{
    //
    function store(Request $request) {

       
        try {

            $request->validate([
                'title' => 'required|string|max:255|unique:departments',
                'description' => 'nullable',
            ]);
    
            Department::create($request->all());
            return response()->json(["Success" => "Category created successfully"], 200);

        } catch(Exception $e) {

            return response()->json(["Error" => $e->getMessage()], 500);
        }
    }

    function delete(Department $department) {
        $department->delete();
        return redirect()->route('settings')->with('success', 'Category deleted successfully.');
    }
}
