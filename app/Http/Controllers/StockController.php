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
}
