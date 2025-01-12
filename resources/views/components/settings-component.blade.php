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
                        <h2>Settings</h2>
                    </div>

                    <div class="settings-body">

                        <div class="settings-card">

                            <div class="popup-modal" id="dptmnt-modal">
                                <div class="popup-modal-content">
                                    <div class="popup-modal-title">
                                        <h4>Create Department</h4>
                                        <button onclick="toggleModal()" type="button">x</button>
                                    </div>
                                    <div class="popup-modal-body">
                                        <div>
                                            <label>Department</label>
                                            <input type="text" name="dpt_title" id='dpt_title' />
                                        </div>
                                        <div>
                                            <label>Description</label>
                                            <input type="text" name="dpt_desc" id="dpt_desc" />
                                        </div>
                                    </div>
                                    <div class="popup-modal-footer">
                                        <button type="button">Cancel</button>
                                        <button type="button" onclick="submitCreateDepartment()">Save</button>
                                    </div>
                                </div>
                            </div>


                            <div class="settings-title">
                                <h4>Departments</h4>
                                    <button type="button" onclick="toggleModal()">
                                        +
                                    </button>
                                </div>
                                <ul>
                                    @foreach ($departments as $dpt)
                                        <li>{{ $dpt->title }}</li>
                                    @endforeach
                                </ul>
                        </div>

                        <div class="settings-card">

                            <div class="popup-modal" id="cats-modal">
                                <div class="popup-modal-content">
                                    <div class="popup-modal-title">
                                        <h4>Create Category</h4>
                                        <button onclick="toggleModalCats()" type="button">x</button>
                                    </div>
                                    <div class="popup-modal-body">
                                        <div>
                                            <label>Category</label>
                                            <input type="text" name="cat_name" id="cat_name" />
                                        </div>
                                        <div>
                                            <label>Description</label>
                                            <input type="text" name="cat_desc" id="cat_desc" />
                                        </div>
                                    </div>
                                    <div class="popup-modal-footer">
                                        <button type="button">Cancel</button>
                                        <button type="button" onclick="submitCreateCategory()">Save</button>
                                    </div>
                                </div>
                            </div>

                            <div class="settings-title">
                                <h4>Categories</h4>
                                <button type="button" onclick="toggleModalCats()">
                                    +
                                </button>
                            </div>

                            <ul>
                                @foreach ($categories as $category)
                                    <li>{{ $category->title  }}</li>
                                @endforeach
                            </li>



                        </div>

                    </div>

                </div>


            </div>

        </div>


        
        <script>
            const modal = document.getElementById("dptmnt-modal");
            function toggleModal() {
                modal.classList.toggle("department-modal-active")
            }
        </script>
        <script>
            const cModal = document.getElementById("cats-modal");
            function toggleModalCats() {
                cModal.classList.toggle("cats-modal-active")
            }
        </script>
        {{-- CREATE DEPARTMENT FUNCTION--}}
        <script>
            function submitCreateDepartment() {
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
            function submitCreateCategory() {

                const cTitle = document.getElementById('cat_name').value;
                const cDesc = document.getElementById('cat_desc').value;

                fetch('/category', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ title : cTitle, description: cDesc })
                })
                .then(response => window.location.href = '/settings' )
                .then(data => {
                    document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                    window.location.href = '/settings';
                })
                .catch(error => console.error('Error:', error));
            }
        </script>
    </body>
</html>