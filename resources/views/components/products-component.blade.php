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

        <div class="modal" id="product-modal">
        
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>New Product</h3>
                    <button class="" onclick="toggleModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Product name</label>
                            <input type="text" name="title" id="title"/>
                        </div>

                        <div class="select-box">
                            <label>UOM</label>
                            <select name="uom" id="uom">
                                <option value="PCS">PCS</option>
                                <option value="Kgs">KGS</option>
                                <option value="CUP">Cup</option>
                                <option value="Btl">Bottle</option>
                                <option value="Plate">Plate</option>
                                <option value="Packet">Packet</option>
                            </select>
                        </div>

                        <div class="input-box">
                            <label>Price</label>
                            <input type="number" id="price" name="price" />
                        </div>

                        <div class="input-box">
                            <label>Opening Stock</label>
                            <input type="text" id="opening_stock" name="opening_stock"  />
                        </div>

                        <div class="select-box">
                            <label>Category</label>
                            <select id="category" name="category">
                                @foreach ($categories as $category)
                                    <option value={{ $category->title }} > {{ $category->title }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="select-box">
                            <label>Department</label>
                            <select id="department" name="department">
                                @foreach ($departments as $dpt)
                                    <option value={{ $dpt->title }} > {{ $dpt->title }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="radio-box">
                            <h4>Is Menu</h4>
                            <label>
                                <input type="radio" id="is_menu" name="is_menu" value="yes"  /> Yes
                            </label>
                            <label>
                                <input type="radio" id="is_menu" name="is_menu" value="no"  /> No
                            </label>
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleModal()">Cancel</button>
                    <button class="" onclick="save()">Submit</button>
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
                        <h2>Products</h2>
                        <button type="button" onclick="toggleModal()">
                            ADD
                        </button>
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
                            <th></th>
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
            const modal = document.getElementById("product-modal");
            function toggleModal() {
                modal.classList.toggle("product-modal-active")
            }
        </script>

        <script>
            function createProduct() {
                const title = document.getElementById('dpt_title').value;
                const description = document.getElementById('dpt_desc').value;

                fetch('/department', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ title, description })
                })
                .then(response =>  window.location.href = '/settings' )
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                   
                })
                .catch(error => console.error('Error:', error));
            }
        </script>

        <script>
            function save() {

                const title = document.getElementById('title').value;
                const uom = document.getElementById('uom').value;
                const price = parseFloat(document.getElementById('price').value);

                const opening_stock = parseInt(document.getElementById('opening_stock').value);
                const category = document.getElementById('category').value;
                const department = document.getElementById('department').value;
                let isMenu = document.querySelector('input[name="is_menu"]:checked').value;
                let is_menu = isMenu == "yes" ? true : false;

                console.log(is_menu)

                fetch('/product', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ title, uom, price, opening_stock, category, department, is_menu })
                })
                .then(response =>  {
                    {{-- window.location.href = '/products';  --}}
                    toggleModal(); })
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                   
                })
                .catch(error => console.error('Error:', error)); 

            }
        </script>

    </body>
</html>