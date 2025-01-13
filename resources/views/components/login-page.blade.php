<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Namitis Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="login-page">

            <div class="login">
                <h2>Namitis Admin</h2>
                <div class="login-form">
                    
                    <div class="input-box">
                        <label>Email</label>
                        <input type="text" name="email" id="email" />
                    </div>

                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" name="password" id="password" />
                    </div>
                    
                    <button type="button" class="filled-button" onclick="login()" >Login</button>
                
                </div>
            </div>

        </div>

        <script>
            function login() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, password })
            })
            .then(response => window.location.href = '/')
            .then(data => {
                document.getElementById('response-message').innerHTML = data.message || 'Department created successfully!';
                window.location.href = '/menu';
            })
            .catch(error => console.error('Error:', error));
        }

        </script>
    </body>
</html>