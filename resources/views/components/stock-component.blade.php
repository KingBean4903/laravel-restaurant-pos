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

        <div class="modal" id="user-modal">
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>Stock Transfer</h3>
                    <button class="" onclick="toggleModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Product</label>
                            <select id="product">
                                @foreach($products as $dpt)
                                    <option value={{ $dpt->id }}>{{ $dpt->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-box">
                            <label>Qtty</label>
                            <input type="number" id="qtty" />
                        </div>
                        <div class="input-box">
                            <label>From</label>
                            <select id="from">
                                @foreach($departments as $dpt)
                                    <option>{{ $dpt->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-box">
                            <label>To</label>
                            <select id="to">
                                @foreach($departments as $dpt)
                                    <option>{{ $dpt->title }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleModal()">Cancel</button>
                    <button class="" onclick="transfer()">Submit</button>
                </div>

            </div>
        </div>

        <div class="modal" id="purchase-modal">
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>Purchase</h3>
                    <button class="" onclick="togglePModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Product</label>
                            <select id="p-product">
                                @foreach($products as $dpt)
                                    <option value={{ $dpt->id }}>{{ $dpt->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-box">
                            <label>Qtty</label>
                            <input type="number" id="p-qtty" />
                        </div>

                        <div class="input-box">
                            <label>Location</label>
                            <select id="p-location">
                                @foreach($departments as $dpt)
                                    <option>{{ $dpt->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-box">
                            <label>Reference</label>
                            <input type="text" id="p-reference" />
                        </div>

                        <div class="input-box">
                            <label>Supplier</label>
                            <input type="text" id="p-supplier" />
                        </div>

                        <div class="input-box">
                            <label>Payment</label>
                            <select id="p-payment">
                                <option value="CASH">CASH</option>
                                <option value="CREDIT">CREDIT</option>
                                <option value="MPESA">MPESA</option>
                            </select>
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="" onclick="togglePModal()">Cancel</button>
                    <button class="" onclick="purchase()">Submit</button>
                </div>

            </div>
        </div>

        <div class="modal" id="adj-modal">
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>Adjust Stock</h3>
                    <button class="" onclick="toggleAdjModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Product</label>
                            <select id="adj_product" disabled>
                                @foreach($products as $dpt)
                                    <option value={{ $dpt->id }}>{{ $dpt->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-box">
                            <label>Qtty</label>
                            <input type="number" id="adj_qtty" />
                        </div>

                        <div class="input-box">
                            <label>Location</label>
                            <select id="adj_location" disabled>
                                @foreach($departments as $dpt)
                                    <option>{{ $dpt->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleAdjModal()">Cancel</button>
                    <button class="" onclick="adjustModal()">Submit</button>
                </div>

            </div>
        </div>

        <div class="dash-grid">

            <div class="dash-topbar">
                <h3>currentuser@gmail.com</h3>
            </div>

            <div class="dash-sidebar">

                <div class="dash-logo">
                    <h3>Namitis</h3>
                </div>

                <ul>
                    <li><a href="/">Menu</a></li>
                    <li><a href="/orders">Orders</a></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/customers">Customers</a></li>
                    <li><a href="/purchases">Purchases</a></li>
                    <li class="active-li"><a href="/inventory">Inventory</a></li>
                    <li><a href="/users">Users</a></li>
                    <li><a href="/settings">Settings</a></li>
                </ul>

                 @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth

            </div>

            <div class="dash-body">

                

                <div class="dash-datatable-view">

                    <div class="dash-datatable-titlebar">
                        <h2>Inventory</h2>
                        <div>
                        <button type="button" onclick="togglePModal()">
                            Add
                        </button>
                        <button type="button" onclick="toggleModal()">
                            Transfer
                        </button>
                        <a href="/audit">Stock Audit</a>
                        </div>
                    </div>

                    <div class="dash-datatable-searchbar">
                        
                        <input type="search" placeholder="Search...." />
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

                        <div class="datatable-export-actions">
                            <button type="button">
                                CSV
                            </button>
                        </div>

                    </div>

                    <table> 
                        <thead>
                            <th>SKU</th>
                            <th>Product</th>
                            <th>In Stock</th>
                            <th>Purchases</th>
                            <th>Transfers</th>
                            <th>Spoilage</th>
                            <th>Location</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ substr($stock->product_id, 0, 8) }}</td>
                                    <td> {{ $stock->title }}  </td>
                                    <td> {{ $stock->in_stock }}</td>
                                    <td> {{ $stock->location }}</td>
                                    <td> 
                                        <button type="button" onclick="openAdjModal({{ Js::from($stock)  }})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                <div>

            </div>

        </div>

        <script>    

            var products = {{ Js::from($products)  }};

            function fetchProduct(id) {

               return products.filter(item => item.id == id)[0].title;
            }

        </script>

        <script>
            
            const modal = document.getElementById("user-modal");
            const pModal = document.getElementById("purchase-modal");

            function toggleModal() {
                modal.classList.toggle("user-modal-active")
            }

            function togglePModal() {
                pModal.classList.toggle("user-modal-active")
            }

        </script>
    
        <script>
            function transfer() {
                const from = document.getElementById('from').value;
                const to = document.getElementById('to').value;
                const qtty = document.getElementById('qtty').value;
                const product_id = document.getElementById('product').value;

                fetch('/transfer', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ from, to, qtty, product_id })
                    })
                    .then(response =>  toggleModal() )
                    .then(data => {
                        document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                    
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>

        <script>
            function purchase() {
                const pRef = document.getElementById('p-reference').value;
                const pLocation = document.getElementById('p-location').value;
                const pQtty = document.getElementById('p-qtty').value;
                const pProduct = document.getElementById('p-product').value;
                const pPayment = document.getElementById('p-payment').value;
                const pSupplier = document.getElementById('p-supplier').value;

                fetch('/purchase', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ref: pRef,
                            location: pLocation,
                            qtty: pQtty,
                            product: pProduct,
                            payment: pPayment,
                            supplier: pSupplier,
                         })
                    })
                    .then(response =>  toggleModal() )
                    .then(data => {
                        document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                    
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>

        <script>
            const adjModal = document.getElementById("adj-modal");

            let stockId = ""

            function toggleAdjModal() {
                adjModal.classList.toggle("adj-modal-active");
            }

            function openAdjModal(stock) {
                toggleAdjModal();
                stockId = stock.id;
                document.getElementById('adj_product').value = stock.product_id;
                document.getElementById('adj_qtty').value = stock.in_stock;
                document.getElementById('adj_location').value = stock.location;
            }

            function adjustModal() {

               const product= document.getElementById('adj_product').value;
               const qtty =  parseInt(document.getElementById('adj_qtty').value);
               const location = document.getElementById('adj_location').value;

                fetch(`/adjustment/${stockId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            qtty: qtty
                         })
                    })
                    .then(response => {}  )
                    .then(data => {
                        document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                    
                    })
                    .catch(error => console.error('Error:', error));

            }

        </script>

    
    </body>
</html>