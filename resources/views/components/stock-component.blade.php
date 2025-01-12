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
                    <li><a href="/inventory">Inventory</a></li>
                    <li><a href="/users">Users</a></li>
                    <li><a href="/settings">Settings</a></li>
                </ul>
            </div>

            <div class="dash-body">

                

                <div class="dash-datatable-view">

                    <div class="dash-datatable-titlebar">
                        <h2>Inventory</h2>
                        <button type="button" onclick="toggleModal()">
                            ADD
                        </button>
                        <a href="/audit">Stock Audit</a>
                    </div>

                    <div class="dash-datatable-searchbar">
                        
                        <input type="searh" placeholder="Search...." />
                        <div class="">
                            <label>
                                <h4>Start Date</h4>
                                <input type="date" name="start_date"  />
                            </label>
                            <label>
                                <h4>End Date</h4>
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

                        </tbody>
                    </table>

                <div>

            </div>

        </div>

        <script>
            
            const modal = document.getElementById("user-modal");

            function toggleModal() {
                modal.classList.toggle("user-modal-active")
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
    
    </body>
</html>