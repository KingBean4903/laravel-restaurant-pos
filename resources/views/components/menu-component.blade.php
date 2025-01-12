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
        <script>

            let dine = "";
            let payment = "";

            function paymentMethod(payMethod) {
                payment = payMethod;
            }

            function dineChoice(dine_method) {
                dine = dine_method;
            }


        </script>
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
                            <input type="radio" name="customer_type" value="is_new" id="customer_type"  />
                            New customer
                        </label>
                        <label>
                            <input type="radio" name="customer_type" value="is_new" id="customer_type" />
                            Existing customer
                        </label>
                    </div>

                    <div class="select-box">
                        <label>Customer</label>
                        <select id="customer">
                        @foreach ($customers as $customer)
                                    <option value="{{ $customer->phone }}"> {{ $customer->names  }} </option>
                                    <option value="{{ $customer->phone }}"> {{ $customer->names }} </option>
                        @endforeach
                        </select>
                    </div>

                    <div class="new-customer-box">
                        <div class="input-box">
                            <label>Customer name</label>
                            <input type="text" id="customer_name" />
                        </div>
                        <div class="input-box">
                            <label>Customer Phone</label>
                            <input type="text" id="customer_phone" />
                        </div>
                    </div>

                    <div class="input-box">
                            <label>Cashier PIN</label>
                            <input type="number" id="cashier" name="cashier" />
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleModal()">Cancel</button>
                    <button class="" onclick="placeOrder()">Submit</button>
                </div>

            </div>

        </div>

        <div class="dash-grid">

            <div class="dash-topbar">
                @if (NULL != Auth::user())
                    <h3>{{ Auth::user()->email }} {{ Auth::user()->name }}</h3>
                @else
                    <button type="button">
                        <a href="/login">Login</a>
                    </button>
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
                                <li onclick="dineChoice(`DINE_IN`)">DINE IN</li>
                                <li onclick="dineChoice(`DELIVERY`)">DELIVERY</li>
                                <li onclick="dineChoice(`TAKE_AWAY`)">TAKE AWAY</li>
                            </ul>
                        </div>

                        <div class="menu-checkout-body" id="menu-checkout-body">

                           
                        </div>

                        <ul>
                            <li onclick="paymentMethod(`MPESA`)">MPESA</li>
                            <li onclick="paymentMethod(`CASH`)">CASH</li>
                            <li onclick="paymentMethod(`CREDIT`)">CREDIT</li>
                        </ul>

                        <div class="menu-checkout-footer">

                            <div class="checkout-row-total">
                                <h3>Subtotal</h3>
                                <h3 id="subtotal">Kes 00.00</h3>
                            </div>

                            <div class="checkout-row-total">
                                <h3>Total</h3>
                                <h2 id="total">Kes 00.00</h2>
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
            
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const meals = {{ Js::from($products) }};

            displayCart();

            const catsDiv = document.getElementById("menu-categories");
            const dishesDiv = document.getElementById("menu-dishes");

            const menu_categories = [
                'Meats', 'Dairies', 'Fresh Juice', 'Fruits',
                'Vegetables', 'Snacks', 'Main Dishes',
                'Hot Beverages', 'Cold Beverages'
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
                title.innerText = one.title;

                const price = document.createElement("h4");
                price.innerText = `Kes ${one.price}`;

                const button = document.createElement("button");
                button.innerText = "Add to Dish";
                button.addEventListener("click", function() {
                    addToCart(one.id);
                });

                card.appendChild(banner);                
                card.appendChild(title);
                card.appendChild(price);
                card.appendChild(button); 

                dishesDiv.appendChild(card);     
            });


        function displayCart() {
            const cartDiv = document.getElementById('menu-checkout-body');
            cartDiv.innerHTML = ''; // Clear the cart

            if (cart.length === 0) {
                cartDiv.innerHTML = '<p>Your cart is empty.</p>';
                return;
            }

            // Display each item in the cart
            cart.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = `
                    <img src="" alt="" class="cart-item-banner" />
                    
                    <div class="cart-details">
                         <p>${item.name}</p>
                         <p> KES ${item.price}</p>
                    </div>
                   
                     <div>
                        <button onclick="decrementQuantity(${index})">-</button>
                        <span> ${item.quantity}</span>
                        <button onclick="incrementQuantity(${index})">+</button>
                    </div>

                    <button class="cart-rmv-btn" onclick="removeFromCart(${index})">Remove</button>
                `;
                cartDiv.appendChild(cartItem);
            });

            // Display total price
            const totalPrice = cart.reduce((total, item) => total + item.price * item.quantity, 0);
            const totalDisplay = document.getElementById('total');
            const subtotal = document.getElementById('subtotal');
            subtotal.innerText = ` KES ${totalPrice}`;
            totalDisplay.innerText = ` KES ${totalPrice}`;
        }

            // Function to increment item quantity in the cart
        function incrementQuantity(index) {
            cart[index].quantity += 1; // Increase the quantity by 1

            // Save the updated cart to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Refresh the cart display
            displayCart();
        }

        // Function to decrement item quantity in the cart
        function decrementQuantity(index) {
            if (cart[index].quantity > 1) {
                cart[index].quantity -= 1; // Decrease the quantity by 1
            } else {
                removeFromCart(index);
                return;
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            displayCart();
        }


            function removeFromCart(index) {
                cart.splice(index, 1); // Remove item at the given index
                localStorage.setItem('cart', JSON.stringify(cart));
                displayCart();
            }

            function addToCart(id) {

                const dish = meals.filter(one => one.id == id)[0];

                const existingItemIndex = cart.findIndex(item => item.name === dish.title);

                if (existingItemIndex !== -1) {
                    cart[existingItemIndex].quantity += 1;
                } else {
                    cart.push({ product_id: id,  name: dish.title, price: parseInt(dish.price), quantity: 1 });
                }
                localStorage.setItem('cart', JSON.stringify(cart));

                displayCart();
            }

        </script>

        <script>

            function placeOrder() {

                const cashier = document.getElementById("cashier").value;
                const customer = document.getElementById("customer").value;
                const customer_name = document.getElementById("customer_name").value;
                const customer_phone = document.getElementById("customer_phone").value;
                const customer_type = document.querySelector('input[name="customer_type"]:checked').value;

                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                let order = {
                    items: cart,
                    is_customer_new: (customer_type == "is_new") ? "1" : "0",
                    customer_phone: customer_phone,
                    customer_name: customer_name,
                    cashier: parseInt(cashier),
                    customer:(customer == "") ? customer_phone : customer,
                    dine: dine,
                    payment: payment,
                    status: (payment == 'CREDIT') ? 'unpaid' : 'paid',
                };

                console.log("Order", order);

                fetch('/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(order)
                })
                .then(response => { 
                    
                    toggleModal();
                    localStorage.setItem('cart', JSON.stringify([]));
                
                })
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                     window.location.href = '/'; 
                })
                .catch(error => console.error('Error:', error));

        } 
        </script>
    </body>
</html>