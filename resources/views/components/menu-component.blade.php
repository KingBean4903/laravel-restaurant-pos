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

        <div class="modal" id="place-order-modal">
        
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>Place Order</h3>
                    <button class="" onclick="toggleModal()">Close</button>
                </div>

                <div class="modal-body">
                
                    <div class="radio-box">
                        <h4>Customer</h4>
                        <label>
                            <input type="radio" name="customer"  />
                            New customer
                        </label>
                        <label>
                            <input type="radio" name="customer" />
                            Existing customer
                        </label>
                    </div>

                    <div class="select-box">
                        <label>Customer</label>
                        <select>
                            <option value="david">David</option>
                            <option value="martin">Martin</option>
                        </select>
                    </div>

                    <div class="new-customer-box">
                        <div class="input-box">
                            <label>Customer name</label>
                            <input type="text" />
                        </div>
                        <div class="input-box">
                            <label>Customer Phone</label>
                            <input type="text" />
                        </div>
                    </div>

                    <div class="input-box">
                            <label>Cashier PIN</label>
                            <input type="text" />
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="">Cancel</button>
                    <button class="" onclick="toggleModal()">Submit</button>
                </div>

            </div>

        </div>

        <div class="dash-grid">

            <div class="dash-topbar">
                @if (NULL != Auth::user())
                <h3>{{ Auth::user()->email }} {{ Auth::user()->name }}</h3>
                @endif
            </div>

            <div class="dash-sidebar">

                <div class="dash-logo">
                    <h3>Namitis</h3>
                </div>

                <ul>
                    <li><a href="/">Menu</a></li>
                    <li><a href="/orders">Orders</a></li>
                    @auth
                    <li><a href="/products">Products</a></li>
                    <li><a href="/customers">Customers</a></li>
                    <li><a href="/purchases">Purchases</a></li>
                    <li><a href="/inventory">Inventory</a></li>
                    <li><a href="/users">Users</a></li>
                    <li><a href="/settings">Settings</a></li>
                    @endauth
                </ul>

                 @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth

            </div>

            <div class="dash-body">
                <div class="menu-body">

                    <div class="menu-categories" id="menu-categories">
                    </div>

                    <div class="menu-dishes" id="menu-dishes">
                    </div>

                    <div class="menu-checkout">
                        <div class="menu-checkout-header">
                            <ul>
                                <li>DINE IN</li>
                                <li>DELIVERY</li>
                                <li>TAKE AWAY</li>
                            </ul>
                        </div>
                        <div class="menu-checkout-body">

                            <div class="checkout-item-row">
                                <img src="" alt="" />
                                <div class="details">
                                    <h3>Product</h3>
                                    <h3>Price</h3>
                                </div>
                                <div class="details">
                                    <button type="button"> 
                                        +
                                    </button>
                                    <h4>Qtty</h4>
                                    <button type="button"> 
                                        -
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="menu-checkout-footer">

                            <div class="checkout-row">
                                <h3>Subtotal</h3>
                                <h3>Kes 45.00</h3>
                            </div>

                            <div class="checkout-row-total">
                                <h3>Total</h3>
                                <h2>Kes 45.00</h2>
                            </div>

                            <button type="button" onclick="toggleModal()">
                                Place Order
                            </button>

                        </div>
                    </div>

                </div>
            </div>

        </div>


        <script>
            
            const modal = document.getElementById("place-order-modal");

            function toggleModal() {
                modal.classList.toggle("order-modal-active")
            }

        </script>
        
        <script>

            const catsDiv = document.getElementById("menu-categories");
            const dishesDiv = document.getElementById("menu-dishes");

            const menu_categories = [
                'Meats', 'Dairies', 'Fresh Juice', 'Fruits',
                'Vegetables', 'Snacks', 'Main Dishes',
                'Hot Beverages', 'Cold Beverages'
            ];

            const meals = [
                {
                    name: 'Chapatis', 
                    uom: 'PC',
                    price: 10.0, 
                    category: 'Snacks',
                    sku: '', 
                },
                {
                    name: 'Chicken (Full)', 
                    uom: 'PC',
                    price: 1000.0, 
                    category: 'Special Orders',
                    sku: '', 
                },
                {
                    name: 'Milk', 
                    uom: 'CUP',
                    price: 30.0, 
                    category: 'Cold Beverages',
                    sku: '', 
                },
            ];

            menu_categories.forEach((one, idx) => {
                const catBox = document.createElement("div");
                catBox.innerHTML = `<h4>${one}</h4>`;
                catBox.classList.add("menu-cat-box");
                catsDiv.appendChild(catBox);
            })

            meals.forEach((one, idx) => {
                const card = document.createElement('div');
                card.classList.add("meals-card");

                const banner = document.createElement('img');
                banner.src = "";
                banner.alt= "banner"
                
                const title = document.createElement("h3");
                title.innerText = one.name;

                const price = document.createElement("h4");
                price.innerText = `Kes ${one.price}`;

                const button = document.createElement("button");
                button.innerText = "Add to Dish";

                card.appendChild(banner);                
                card.appendChild(title);
                card.appendChild(price);
                card.appendChild(button); 

                dishesDiv.appendChild(card);     
            });



        
        </script>
    </body>
</html>