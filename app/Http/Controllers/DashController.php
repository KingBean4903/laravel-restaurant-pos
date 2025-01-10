<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{

    // MenuIndex:  load menu page
    function menuIndex() {
        return view('components.menu-component');
    }

    // OrdersIndex:  load orders page
    function ordersIndex() {
        return view('components.orders-component');
    }

    // ProductsIndex:  load products page
    function productsIndex() {
        return view('components.products-component');
    }

    // customersIndex:  load customers page
    function customersIndex() {
        return view('components.customers-component');
    }

    // settingsIndex:  load settings page
    function settingsIndex() {
        return view('components.settings-component');
    }

    // usersIndex:  load settings page
    function usersIndex() {
        return view('components.users');
    }

    // inventoryIndex:  load inventory page
    function inventoryIndex() {
        return view('components.stock-component');
    }

}
