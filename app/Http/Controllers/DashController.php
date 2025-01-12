<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Department;
use App\Models\Product;
use App\Models\Customer;

class DashController extends Controller
{

    // 
    function audit() {

        $products = Product::all();
        $departments = Department::all();

        return view('components.stock-audit', 
        [
            'products' => $products,
            'departments' => $departments,
        ]);
    }

    // MenuIndex:  load menu page
    function menuIndex() {

        $products = Product::all();
        $customers = Customer::all();

        return view('components.menu-component',
         ['products' => $products,
          'customers' => $customers,
        ]);
    }

    // OrdersIndex:  load orders page
    function ordersIndex() {
        return view('components.orders-component');
    }

    // ProductsIndex:  load products page
    function productsIndex() {
        
        $categories = Category::all();
        $departments = Department::all();

        return view('components.products-component',
                [ 
                    'categories' => $categories,
                    'departments' => $departments,
                 ]);
    
    }

    // customersIndex:  load customers page
    function customersIndex() {
        return view('components.customers-component');
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
        return view('components.users');
    }

    // inventoryIndex:  load inventory page
    function inventoryIndex() {

        $categories = Category::all();
        $departments = Department::all();
        $products = Product::all();

        return view('components.stock-component',[
            'products' => $products,
            'categories' => $categories,
            'departments' => $departments
        ]);
    }

}
