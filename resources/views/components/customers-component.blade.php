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
        <div class="modal" id="customer-modal">
        
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>New Customer</h3>
                    <button class="" onclick="toggleModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Customer name</label>
                            <input type="text" id="names" name="names" />
                        </div>
                        <div class="input-box">
                            <label>Customer Phone</label>
                            <input type="text" id="phone" name="phone" />
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleModal()">Cancel</button>
                    <button class="" onclick="submitCustomer()">Save</button>
                </div>

            </div>

        </div>

        <div class="modal" id="customer-update-modal">
        
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>Edit Customer</h3>
                    <button class="" onclick="toggleUpModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Customer name</label>
                            <input type="text" id="unames" name="unames" />
                        </div>
                        <div class="input-box">
                            <label>Customer Phone</label>
                            <input type="text" id="uphone" name="uphone" />
                        </div>

                </div>

                <div class="modal-footer">
                    <button class="" onclick="toggleUpModal()">Cancel</button>
                    <button class="" onclick="updateCustomer()">Save</button>
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
                    <li><a href="/inventory">Inventory</a></li>
                    <li><a href="/users">Users</a></li>
                    <li><a href="/settings">Settings</a></li>
                </ul>
            </div>

            <div class="dash-body">

                <div class="dash-datatable-view">

                    <div class="dash-datatable-titlebar">
                        <h2>Customers</h2>
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
                            <th>Created</th>
                            <th>Names</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->created_at }}</td>
                                    <td>{{ $customer->names }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td></td>
                                    <td>
                                        <button type="button" onclick="openUpModal({{ Js::from($customer) }})">Update</button>
                                        <button type="button" onclick="deleteCustomer({{ Js::from($customer)  }})">x</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                <div>



            </div>

        </div>


        
        
        <script>
            
            const modal = document.getElementById("customer-modal");

            function toggleModal() {
                modal.classList.toggle("order-modal-active")
            }

        </script>

        <script>
            function submitCustomer() {

                const names = document.getElementById('names').value;
                const phone = document.getElementById('phone').value;

                fetch('/customers', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ names, phone })
                })
                .then(response =>{ window.location.href = '/customers'; toggleModal(); })
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                })
                .catch(error => console.error('Error:', error));
            }
        </script>

        

        <script>

            let customerId = "";
            
            const umodal = document.getElementById("customer-update-modal");

            function toggleUpModal() {
                umodal.classList.toggle("order-modal-active")
            }

            function openUpModal(user) {
                toggleUpModal();
                customerId = user.id;
                document.getElementById('unames').value = user.names;
                document.getElementById('uphone').value = user.phone;
            }

            function updateCustomer(user) {

                const unames = document.getElementById('unames').value;
                const uphone = document.getElementById('uphone').value;

                fetch(`/customers/${customerId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ names: unames, phone: uphone })
                })
                .then(response =>{  toggleUpModal(); })
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                })
                .catch(error => console.error('Error:', error));

            }

        </script>

        <script>
            function deleteCustomer(user) {

                fetch(`/customers/${user.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        
                    })
                    .then(response => toggleModal() )
                    .then(data => {
                        document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                        window.location.href = '/settings';
                    })
                    .catch(error => console.error('Error:', error));

            }
        </script>
    </body>
</html>