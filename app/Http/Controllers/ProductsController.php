<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockTrxn;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    // store: function to save product
    public function store(Request $request) {

        try {

            $validated = $request->validate([
                'title' => 'required|string|unique:products,title',
                'uom' => 'required|string',
                'category' => 'required|string',
                'department'=> 'required|string',
                'opening_stock' => 'required|numeric|integer', 
                'is_menu' => 'required|boolean',
                'is_dish' => 'required|boolean',
                'price' => 'required|integer'
            ]);

            $product = Product::create([
                'title' => $validated['title'],
                'uom' => $validated['uom'],
                'category' => $validated['category'],
                'department' => $validated['department'],
                'opening_stock' => $validated['opening_stock'],
                'is_menu' => $validated['is_menu'],
                'is_dish' => $validated['is_dish'],
                'price' => $validated['price']
            ]);


                Stock::create([
                    'location' => $product->department,
                    'status' => 'in_stock',
                    'product_id' => $product->id,
                    'in_stock' => $product->opening_stock,
                ]);

                StockTrxn::create([
                    'qtty' => $product->opening_stock,
                    'stock_before' => 0,
                    'stock_after' => $product->opening_stock,
                    'reason' => 'opening_stock',
                    'trxn_type' => 'opening_stock',
                    'user' => Auth::user()->id,
                    'product_id' => $product->id,
                    'location_to' => $product->department,
                    'location_from' => $product->department,
                ]);

          

            


            return response()->json(['Success' => 'Product created successfully'], 200);

        } catch(Exception $e) {

            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Product $product) {


        try {

            $validated = $request->validate([
                'title' => 'required|string',
                'uom' => 'required|string',
                'category' => 'required|string',
                'department'=> 'required|string',
                'is_menu' => 'required|boolean',
                'is_dish' => 'required|boolean',
                'price' => 'required|integer'
            ]);

            $product->update($request->all());

            return response()->json(['Success' => 'Product created successfully'], 200);

        } catch(Exception $e) {

            return response()->json(['Error' => $e->getMessage()], 500);
        }



    }

    // Delete customer
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['Success' => 'Deleted customer successfully'],  200);
        } catch (Exception $e) {
            return response()->json(['Error' => 'Failed to create customer'], 500);
        }

    }
}
