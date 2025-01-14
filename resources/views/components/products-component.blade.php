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

                        <div class="radio-box">
                            <h4>Is Dish</h4>
                            <label>
                                <input type="radio" id="is_dish" name="is_dish" value="yes"  /> Yes
                            </label>
                            <label>
                                <input type="radio" id="is_dish" name="is_dish" value="no"  /> No
                            </label>
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleModal()">Cancel</button>
                    <button class="" onclick="save()">Submit</button>
                </div>

            </div>

        </div>

        <div class="modal" id="update-product-modal">
        
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>Edit Product</h3>
                    <button class="" onclick="toggleUpdateModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Product name</label>
                            <input type="text" name="title" id="utitle"/>
                        </div>

                        <div class="select-box">
                            <label>UOM</label>
                            <select name="uom" id="uuom">
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
                            <input type="number" id="uprice" name="price" />
                        </div>


                        <div class="select-box">
                            <label>Category</label>
                            <select id="ucategory" name="category">
                                @foreach ($categories as $category)
                                    <option value={{ $category->title }} > {{ $category->title }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="select-box">
                            <label>Department</label>
                            <select id="udepartment" name="department">
                                @foreach ($departments as $dpt)
                                    <option value={{ $dpt->title }} > {{ $dpt->title }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="radio-box">
                            <h4>Is Menu</h4>
                            <label>
                                <input type="radio" id="uis_menu" name="uis_menu" value="yes"  /> Yes
                            </label>
                            <label>
                                <input type="radio" id="uis_menu" name="uis_menu" value="no"  /> No
                            </label>
                        </div>

                        <div class="radio-box">
                            <h4>Is Dish</h4>
                            <label>
                                <input type="radio" id="is_dish" name="uis_dish" value="yes"  /> Yes
                            </label>
                            <label>
                                <input type="radio" id="is_dish" name="uis_dish" value="no"  /> No
                            </label>
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleModal()">Cancel</button>
                    <button class="" onclick="updateProduct()">Submit</button>
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
                    <li class="active-li"><a href="/products">Products</a></li>
                    <li><a href="/customers">Customers</a></li>
                    <li><a href="/inventory">Inventory</a></li>
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
                        <h2>Products</h2>
                        <button type="button" class="filled-button" onclick="toggleModal()">
                            ADD
                        </button>
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

                        <div class="datatable-export-actions">
                            <button type="button">
                                CSV
                            </button>
                        </div>

                    </div>

                    <table> 
                        <thead>
                            <th>SKU</th>
                            <th>Title</th>
                            <th>UOM</th>
                            <th>Price</th>
                            <th>Department</th>
                            <th>Category</th>
                            <th>Menu</th>
                            <th>Dish</th>
                            <th>Opening Stock</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ substr($product->id, 0 , 10)  }}</td>
                                    <td style="font-weight: 600;">{{ $product->title  }}</td>
                                    <td>{{ $product->uom  }}</td>
                                    <td>{{ $product->price  }}</td>
                                    <td>{{ $product->department  }}</td>
                                    <td>{{ $product->category  }}</td>
                                    <td>{{ $product->is_menu ? "TRUE" : "FALSE" }}</td>
                                    <td>{{ $product->is_dish ? "TRUE" : "FALSE" }}</td>
                                    <td>{{ $product->opening_stock  }}</td>
                                    <td>
                                        <button type="button" onclick="openEditModal({{ Js::from($product) }})">Edit</button>
                                        <button type="button" onclick="deleteItem({{ Js::from($product) }})">x</button>
                                    </td>
                                </tr>
                            @endforeach
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

            let productId = "";

            const uModal = document.getElementById("update-product-modal");

            function toggleUpdateModal() {
                uModal.classList.toggle("update-product-modal-active")
            }
            

            function openEditModal(product) {

                productId = product.id;

                toggleUpdateModal();

                document.getElementById('utitle').value = product.title;
                document.getElementById('uuom').value = product.uom;
                document.getElementById('uprice').value = product.price;

                document.getElementById('ucategory').value = product.category;
                document.getElementById('udepartment').value = product.department;

             
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

                let isDish = document.querySelector('input[name="is_dish"]:checked').value;
                let is_dish = isDish == "yes" ? true : false;

                console.log(is_menu)

                fetch('/product', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ title, uom, price, opening_stock, category, department, is_menu, is_dish })
                })
                .then(response =>  {
                    window.location.href = '/products';  
                    toggleModal(); })
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                   
                })
                .catch(error => console.error('Error:', error)); 

            }
        </script>

        <script>
            function updateProduct() {

                const utitle = document.getElementById('utitle').value;
                const uuom = document.getElementById('uuom').value;
                const uprice = parseFloat(document.getElementById('uprice').value);

                const ucategory = document.getElementById('ucategory').value;
                const udepartment = document.getElementById('udepartment').value;
                let uisMenu = document.querySelector('input[name="uis_menu"]:checked').value;
                let uis_menu = uisMenu == "yes" ? true : false;

                let uisDish = document.querySelector('input[name="uis_dish"]:checked').value;
                let uis_dish = uisDish == "yes" ? true : false;


                fetch(`/products/${productId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        title : utitle, 
                        uom: uuom, 
                        price : uprice, 
                        category: ucategory, 
                        department: udepartment, 
                        is_menu: uis_menu,
                        is_dish: uis_dish,
                    })
                })
                .then(response =>  { })
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                   
                })
                .catch(error => console.error('Error:', error)); 

            }
        </script>

        <script>
            function deleteItem(product) {

                fetch(`/products/${product.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        
                    })
                    .then(response => {

                            window.location.href = "/";

                    }  )
                    .then(data => {
                        document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                    })
                    .catch(error => console.error('Error:', error));

            }
        </script>

    </body>
</html>