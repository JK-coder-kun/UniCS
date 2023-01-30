<html>
<?php
// header("refresh: 2");
?>

<head>
    <title>Login</title>
    <script src="bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-image:url('https://raw.githubusercontent.com/JK-coder-kun/UniCS/frontend/images/bg-1.jpg');background-size:cover;">
    <div class="container d-flex" style='height:100%'>
        <!-- main -->
        <div class='container justify-content-center d-flex align-items-center'>
            <div class="bg-light-subtle p-5 col-md-6 container rounded-4">
                <h1 class='' style='text-align:center'>uniCS</h1>
                <form action='home.html.php'>
                    <div class='form-group form-floating mb-3'>
                        <input type='email' class='form-control' id='email' placeholder='Email address' />
                        <label for='email'>Email address</label>
                    </div>
                    <div class='form-group form-floating mb-3'>
                        <input type='password' class='form-control' id='password' placeholder='Password' />
                        <label for='password'>Password</label>
                    </div>
                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                    <div class='d-flex flex-column align-items-center mt-2' style='width:100%'>
                        <button type='submit' class='btn btn-primary btn-lg rounded-2' style='width:35%;'>Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    </div>

</body>

</html>