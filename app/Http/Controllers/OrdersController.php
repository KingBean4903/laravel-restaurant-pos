<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\StockTrxn;
use App\Models\Stock;
use Exception;

use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    //
    public function placeOrder(Request $request)  
    {

                Log::info("Orders-----------------------");

                try {

                $request->validate([
                    'is_customer_new' => 'boolean',
                    'customer_phone' => 'nullable|string',
                    'customer_name' => 'nullable|string',
                    'customer' => 'required|string',
                    'payment' => 'required|in:MPESA,CASH,CREDIT',
                    'dine' => 'required|in:DELIVERY,DINE_IN,TAKE_AWAY',
                    'status' => 'required|in:paid,unpaid,cancelled,partially_paid',
                    'cashier' => 'required|numeric',
                    'items' => 'required|array',
                    'items.*.product_id' => 'required',
                    'items.*.quantity' => 'required|numeric|min:1',
                    'items.*.price' => 'required|numeric|min:0.01',
                ]);
        
                $customer = Customer::firstOrCreate(
                    ['phone' => $request->customer],
                    ['names' => $request->customer_name],
                );

                $cashier = User::where('pin', $request->cashier)->first();                


                if ($cashier) {
                    

                    $order = Order::create([
                        'customer_id' => $customer->names. " " . "($customer->phone)" ,
                        'dine' => $request->dine,
                        'payment' => $request->payment,
                        'status' => $request->status,
                        'cashier' => $cashier->name,
                        'total' => $this->calculateTotalAmount($request->items),
                    ]);

                    foreach ($request->items as $item) {

                        

                         OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'product_name' => $item['name'],
                            'total' => ($item['price'] * $item['quantity']),
                            'price' => $item['price'],
                        ]);

                        $stock = Stock::where('product_id', $item['product_id'])->first();
                        
                        StockTrxn::create([
                            'stock_before' => $stock->in_stock,
                            'stock_after' => $stock->in_stock -= $item['quantity'],
                            'trxn_type' => 'sale',
                            'reason' => 'sale',
                            'product_id' => $item['product_id'],
                            'user' => $cashier->names."/".$cashier->phone,
                            'ref_code' => $order->id,
                            'qtty' => $stock->in_stock -= $item['quantity'],
                            'location_to' => $stock->location,
                            'location_from' => $stock->location,
                         ]);

                        
                        $stock->in_stock -= $item['quantity'];
                        $stock->save();
                        
                    }

                    return response()
                            ->json([ 'data' => [ 'Message' =>  'Order created successfully' ] ], 200);
                }
                else {
                    return response()
                    ->json([ 'data' => ['Message' => 'Cashier does not exist' ] ], 400);
                }   
                

            } catch(Exception $e) {

                return response()
                    ->json([ 'data' => [ 'Message' => $e->getMessage() ] ], 500);
            }
    
    }

    private function calculateTotalAmount($items)
    {
        $totalAmount = 0;
        foreach ($items as $item) {
            $totalAmount += $item['quantity'] * $item['price'];
        }
        return $totalAmount;
    }

}
