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
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
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
                    <h3>Add User</h3>
                    <button class="" onclick="toggleModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Names</label>
                            <input type="text" id="name" />
                        </div>
                        <div class="input-box">
                            <label>Phone</label>
                            <input type="text" id="phone" />
                        </div>
                        <div class="input-box">
                            <label>Email</label>
                            <input type="text" id="email" />
                        </div>
                        <div class="input-box">
                            <label>PIN</label>
                            <input type="number" max="4" min="4" id="pin" />
                        </div>
                        <div class="input-box">
                            <label>Password</label>
                            <input type="text" id="password" />
                        </div>
                        <div class="select-box">
                            <label>Role</label>
                            <select id='role'>
                                <option value="ADMIN">ADMIN</option>
                                <option value="CASHIER">CASHIER</option>
                                <option value='MANAGER'>MANAGER</option>
                            </select>
                        </div>

                </div>

                <div class="modal-footer">
                    <button class=""  onclick="toggleModal()">Cancel</button>
                    <button class="" onclick="createUser()">Save</button>
                </div>

            </div>
        </div>

        <div class="modal" id="user-update-modal">
            <div class="modal-content" >
                
                <div class="modal-title">
                    <h3>Update User</h3>
                    <button class="" onclick="toggleUpdateModal()">Close</button>
                </div>

                <div class="modal-body">
                
                        <div class="input-box">
                            <label>Names</label>
                            <input type="text" id="ename" />
                        </div>
                        <div class="input-box">
                            <label>Phone</label>
                            <input type="text" id="ephone" />
                        </div>
                        <div class="input-box">
                            <label>Email</label>
                            <input type="text" id="eemail" />
                        </div>
                        <div class="input-box">
                            <label>PIN</label>
                            <input type="number" max="4" min="4" id="epin" />
                        </div>
                        <div class="input-box">
                            <label>Password</label>
                            <input type="text" id="epassword" />
                        </div>
                        <div class="select-box">
                            <label>Role</label>
                            <select id='erole'>
                                <option value="ADMIN">ADMIN</option>
                                <option value="CASHIER">CASHIER</option>
                                <option value='MANAGER'>MANAGER</option>
                            </select>
                        </div>

                </div>

                <div class="modal-footer">
                    <button class=""  onclick="toggleUpdateModal()">Cancel</button>
                    <button class="" onclick="updateUser()">Save</button>
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
                    @auth
                        <li><a href="/products">Products</a></li>
                        <li><a href="/customers">Customers</a></li>
                        <li><a href="/purchases">Purchases</a></li>
                        <li><a href="/inventory">Inventory</a></li>
                        <li class="active-li"><a href="/users">Users</a></li>
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

                <div class="dash-datatable-view">

                    <div class="dash-datatable-titlebar">
                        <h2>Users</h2>
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
                            <th>Created</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->created_at  }}</td>
                                    <td>{{ $user->name  }}</td>
                                    <td>{{ $user->email  }}</td>
                                    <td>{{ $user->phone  }}</td>
                                    <td>{{ $user->role  }}</td>
                                    <td>
                                        <button type="button" onclick="updateModal({{ Js::from($user) }})">Edit</button>
                                        <button type="button" onclick="deleteUser({{ Js::from($user)}})">Dlt</button>
                                    </td>
                                </tr>
                            @endforeach
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

            let userId = "";

            function toggleUpdateModal() {
                const uModal = document.getElementById('user-update-modal');
                uModal.classList.toggle("update-user-modal");
            }

            function updateModal(user) {

                userId = user.id;

                toggleUpdateModal()
                document.getElementById("ename").value = user.name;
                document.getElementById("ephone").value = user.phone;
                document.getElementById("eemail").value = user.email;
                document.getElementById("epin").value = user.pin;
                document.getElementById("erole").value = user.role;

            }

            function updateUser() {

                const name = document.getElementById('ename').value;
                const phone = document.getElementById('ephone').value;
                const email = document.getElementById('eemail').value;
                const pin = parseInt(document.getElementById('epin').value);
                const password = document.getElementById('epassword').value;
                const role = document.getElementById('erole').value;

                fetch(`/users/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, phone, email, pin, password, role })
                })
                .then(response => toggleModal() )
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                    window.location.href = '/settings';
                })
                .catch(error => console.error('Error:', error));

            }
        </script>

        <script>
            function deleteUser(user) {

                fetch(`/users/${user.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name, phone, email, pin, password, role })
                    })
                    .then(response => toggleModal() )
                    .then(data => {
                        document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                        window.location.href = '/settings';
                    })
                    .catch(error => console.error('Error:', error));

            }
        </script>

        
        <script>
            function createUser() {

                const name = document.getElementById('name').value;
                const phone = document.getElementById('phone').value;
                const email = document.getElementById('email').value;
                const pin = parseInt(document.getElementById('pin').value);
                const password = document.getElementById('password').value;
                const role = document.getElementById('role').value;

                fetch('/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, phone, email, pin, password, role })
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