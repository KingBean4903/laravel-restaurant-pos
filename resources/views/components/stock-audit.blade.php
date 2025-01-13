<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
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
                        <h2>Stock Audit</h2>
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
                            <th>Date/Time </th>
                            <th>Product</th>
                            <th>Auditor</th>
                            <th>Physical Stock</th>
                            <th>Spoilage</th>
                            <th>Location</th>
                        </thead>
                        <tbody>
                            @foreach ($audits as $audit)
                                <tr>
                                    <td>{{ $audit->created_at }}</td>
                                    <td>{{ $audit->title }}</td>
                                    <td>{{ $audit->name }}</td>
                                    <td>{{ $audit->physical_qtty }}</td>
                                    <td>{{ $audit->spoilage }}</td>
                                    <td>{{ $audit->location }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="stock-audit">
                        <div>
                            <label>Product</label>
                            <select id="product_id">
                                @foreach ($products as $product)
                                    <option value={{ $product->id }} >{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Physical Qtty</label>
                            <input type="text" id="physical_qtty" />
                        </div>
                        <div>
                            <label>Spoilage</label>
                            <input type="text" id="spoilage"/>
                        </div>
                        <div>
                            <label>Location</label>
                            <select id="location">
                                @foreach ($departments as $dpt)
                                    <option value={{ $dpt->title }}> {{ $dpt->title  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="filled-button" onclick="save()">SAVE</button>
                    </div>
                <div>
            </div>
        </div>
        
        <script>

            function save() {

                const location = document.getElementById('location').value;
                const spoilage = parseInt(document.getElementById('spoilage').value);
                const physical_qtty = parseInt(document.getElementById('physical_qtty').value);
                const product_id = document.getElementById('product_id').value;

                fetch('/stock-audit', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ location, spoilage, physical_qtty, product_id })
                    })
                    .then(response =>  console.log(response.body) )
                    .then(data => {

                    
                    })
                    .catch(error => console.error('Error:', error));
            } 

        </script>
    </body>
</html>