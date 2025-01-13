<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Namitis</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="dash-grid">

            <div class="dash-topbar">
                @if (NULL != Auth::user())
                    <h3>{{ Auth::user()->email }} {{ Auth::user()->name }}</h3>
                @else
                    <button type="button" class="filled_button">
                        <a href="/login">Login</a>
                    </button>
                @endif
            </div>

            <div class="dash-sidebar">

                <div class="dash-logo">
                    <h3>Namitis</h3>
                </div>

                <ul>
                     <li ><a href="/">Menu</a></li>
                    <li class="active-li"> <a href="/orders">Orders</a></li>
                    @auth
                    <li><a href="/products">Products</a></li>
                    <li><a href="/customers">Customers</a></li>
                    <li><a href="/inventory">Inventory</a></li>
                    <li><a href="/users">Users</a></li>
                    <li><a href="/settings">Settings</a></li>
                    @endauth
                </ul>

                 @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button  type="submit">Logout</button>
                    </form>
                @endauth

            </div>

            <div class="dash-body">

                <div class="dash-datatable-view">

                    <div class="dash-datatable-titlebar">
                        <h2>Orders</h2>
                       
                    </div>
                     
                    <div class="dash-datatable-searchbar">
                        
                        <input type="searh" placeholder="Search...." />
                        <div class="dates-filter">
                            <label>
                                Start Date
                                <input type="date" name="start_date"  />
                            </label>
                            <label>
                                End Date
                                <input type="date" name="start_date"  />
                            </label>
                        </div>

                        @auth
                            <div class="datatable-export-actions">
                                <button type="button">
                                    CSV
                                </button>
                            </div>
                        @endauth
                    </div>
                     
                    <table> 
                        <thead>
                            <th>Order Date </th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Payment</th>
                            <th>Dine</th>
                            <th>Status</th>
                            <th>Cashier</th>
                            <th>Total</th>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td> {{ $order->created_at  }} </td>
                                    <td class="bold_td"> {{ substr($order->id, 0, 8)  }} </td>
                                    <td> {{ $order->customer_id  }} </td>
                                    <td> {{ $order->payment  }} </td>
                                    <td> {{ $order->dine  }} </td>
                                    <td class="bold_td"> {{ $order->status  }} </td>
                                    <td> {{ $order->cashier  }} </td>
                                    <td> Kes {{ $order->total  }} </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                <div>
                



            </div>

        </div>


        
        <script src="" async defer></script>
    </body>
</html>