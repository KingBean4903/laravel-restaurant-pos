<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Exception;

class CustomersController extends Controller
{
    // store : save user
    public function store(Request $request) {
        
        try {

            $validated = $request->validate([
                'names' => 'required|string',
                'phone' => 'required|string'
            ]);

            Customer::create([
                'names' => $validated['names'],
                'phone' => $validated['phone'],
            ]);

            return response()->json(['Success' => 'Created customer successfully'],  200);

        } catch(Exception $e) {

            return response()->json(['Error' => 'Failed to create customer'], 500);
        }
    }

    // Update customer
    public function update(Request $request, Customer $customer)
    {
        try {

            $request->validate([
                'names' => 'required|string|max:255',
                'phone' => 'required|string',
            ]);

            $customer->update($request->all());

            return response()->json(['Success' => 'Updated customer successfully'],  200);

        } catch(Exception $e) {

            return response()->json(['Error' => $e->getMessage()], 500);
        }

    }

    // Delete customer
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return response()->json(['Success' => 'Deleted customer successfully'],  200);
        } catch (Exception $e) {
            return response()->json(['Error' => 'Failed to create customer'], 500);
        }

    }


}
