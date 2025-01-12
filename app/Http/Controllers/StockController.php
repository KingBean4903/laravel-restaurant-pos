<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTrxn;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use App\Models\StockAudit;
use Carbon\Carbon;

class StockController extends Controller
{
    //

    public function purchase(Request $request) {

        try { 

            $validated = $request->validate([
                'product' => 'required|string',
                'payment' => 'required|string',
                'supplier' => 'required|string',
                'qtty'=> 'required|integer',
                'location' => 'required|string',
                'ref' => 'required|string'
            ]);

            $stock = Stock::where('product_id', $validated['product'])->first();
            
            StockTrxn::create([
                'qtty' => $validated['qtty'],
                'stock_before' => $stock->in_stock,
                'stock_after' => $stock->in_stock += $validated['qtty'],
                'reason' => 'Purchase',
                'trxn_type' => 'purchase',
                'ref_code' => $validated['ref']."/".$validated['supplier']."/".$validated['payment'],
                'product_id' => $validated['product'],
                'user' => Auth::user()->id,
            ]);

            $stock->in_stock += $validated['qtty'];
            $stock->location = $validated['location'];
            $stock->save();

            return response()->json(['Success' => 'Created purchase'], 200);

        } catch(Exception $e) {

            return response()->json(['Error' => $e->getMessage()], 500);

        }

    }

    public function transfer(Request $request) {

        try {
                $stock = Stock::where('product_id', $request->product_id)->first();

                StockTrxn::create([
                    'product_id' => $request->product_id,
                    'trxn_type' => 'transfer',
                    'location_from' => $request->from,
                    'location_to' => $request->to,
                    'ref_code' => 'TRANSFER',
                    'reason' => 'transfer',
                    'qtty' => $request->qtty,
                    'stock_before' => $stock->in_stock,
                    'stock_after' => $stock->in_stock - $request->qtty,
                    'user' => Auth::user()->id,
                ]);

                return response()->json(['Success' => 'Product transferd successfully'], 200);

            } catch(Exception $e) {

                return response()->json(['Error' => $e->getMessage()], 500);
            }
    }

    public function stockAudit(Request $request) {

        
        try {

            $validated = $request->validate([
                'location' => 'required|string',
                'spoilage' => 'required|integer',
                'physical_qtty' => 'required|integer',
                'product_id' => 'required|string',
            ]);

            $entryExists = StockAudit::where('product_id', $validated['product_id'])
                        ->whereDate('created_at', Carbon::today())
                        ->exists();

            if ($entryExists) {

                return response()->json(['Message' => 'Stock audit already exists'], 400);

            } else {

                $stock = Stock::where('product_id', $validated['product_id'])->first();

                $stockAudit  = StockAudit::create([
                    'user' => Auth::user()->id,
                    'product_id' => $validated['product_id'],
                    'location' => $validated['location'],
                    'spoilage' => $validated['spoilage'],
                    'physical_qtty' => $validated['physical_qtty'],
                ]);

                StockTrxn::create([
                    'product_id' => $validated['product_id'],
                    'trxn_type' => 'audit',
                    'ref_code' => $stockAudit->id,
                    'user' => Auth::user()->id,
                    'qtty' => $validated['physical_qtty'],
                    'stock_before' => $stock->in_stock,
                    'stock_after' => $validated['physical_qtty'],
                    'reason' => 'AUDIT',
                ]);
                
                
                $stock->in_stock =  $validated['physical_qtty'];
                $stock->save();



                return response()->json(['Message' => 'Stock audit saved successfully'], 200);
            }

        } catch(Exception $e) {

            return response()->json(['Error' => $e->getMessage()], 500);

        }

    }

    public function adjust(Request $request, Stock $stock) {

        try {

            $validated = $request->validate([
                'qtty' => 'required|numeric'
            ]);

            StockTrxn::create([
                'product_id' => $stock->product_id,
                'trxn_type' => 'adjustment',
                'ref_code' => "ADJUSTMENT",
                'user' => Auth::user()->id,
                'qtty' => $validated['qtty'],
                'stock_before' => $stock->in_stock,
                'stock_after' =>  $validated['qtty'],
                'reason' => 'ADJUSTMENT',
            ]);

            // $stock->in_stock = $validated['qtty'];
            $stock->update(['in_stock' => $validated['qtty']]);

            return response()->json(['Success' => 'Updated successfully']);

        } catch(Exception $e) {
            return response()->json(['Error' => $e->getMessage()]);
        }

    }
}
