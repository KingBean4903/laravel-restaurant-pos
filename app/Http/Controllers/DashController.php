<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Department;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;
use App\Models\Stock;
use App\Models\Order;
use App\Models\StockAudit;
use Illuminate\Support\Facades\DB;


class DashController extends Controller
{

    // 
    function audit() {

        $products = Product::all();
        $departments = Department::all();

        $audits = DB::table('stock_audits')
            ->join('products', 'stock_audits.product_id',  '=', 'products.id')
            ->join('users', 'stock_audits.user', '=', 'users.id')
            ->select('stock_audits.id', 'stock_audits.location', 'stock_audits.product_id', 
                    'stock_audits.spoilage','stock_audits.created_at', 'users.name',
                    'stock_audits.user',
                     'stock_audits.physical_qtty', 'products.title')
            ->get();

        return view('components.stock-audit', 
        [
            'products' => $products,
            'departments' => $departments,
            'audits' => $audits,
        ]);
    }

    // MenuIndex:  load menu page
    function menuIndex() {

        $products = Product::all();
        $customers = Customer::all();

        $productsJoin = DB::table('products')
            ->join('stocks', 'stocks.product_id',  '=', 'products.id')
            ->select(
                'products.title', 'products.price', 'products.uom', 'products.is_menu',
                'stocks.id', 'stocks.location', 'stocks.product_id', 'stocks.in_stock', 'products.title')
            ->get();

        return view('components.menu-component',
         ['products' => $productsJoin,
          'customers' => $customers,
        ]);
    }

    // OrdersIndex:  load orders page
    function ordersIndex() {

        $orders = Order::all()->reverse();

        return view('components.orders-component', [
            'orders' => $orders
        ]);
    }

    // ProductsIndex:  load products page
    function productsIndex() {
        
        $categories = Category::all();
        $departments = Department::all();
        $products = Product::all();

        return view('components.products-component',
                [ 
                    'categories' => $categories,
                    'departments' => $departments,
                    'products' => $products,
                 ]);
    
    }

    // customersIndex:  load customers page
    function customersIndex() {

        $customers = Customer::all();

        return view('components.customers-component',[
            'customers' => $customers,
        ]);
    }

    // settingsIndex:  load settings page
    function settingsIndex() {

        $categories = Category::all();
        $departments = Department::all();

        return view('components.settings-component',
            [
                'categories' => $categories,
                'departments' => $departments,
            ]
        );
    }

    // usersIndex:  load settings page
    function usersIndex() {
        
        $users = User::all();

        return view('components.users',
                [
                    'users' => $users,
                ]);
    }

    // inventoryIndex:  load inventory page
    function inventoryIndex() {

        $categories = Category::all();
        $departments = Department::all();
        $products = Product::all();
        $stocks = Stock::all();


        $stocksJoin = DB::table('stocks')
            ->join('products', 'stocks.product_id',  '=', 'products.id')
            ->select(
                'stocks.id', 'stocks.location', 'stocks.product_id', 'stocks.in_stock', 'products.title')
            ->get();

        return view('components.stock-component',[
            'products' => $products,
            'categories' => $categories,
            'departments' => $departments,
            'stocks' => $stocksJoin,
        ]);
    }

}
