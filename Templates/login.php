<html>
<head>
    <title>Login System</title>
    <link rel="stylesheet" type="text/css" href="Styles/homeStyle.css">
</head>
<body>
<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Login</h1><br>
            <form action="?action=checkLogin" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="execute" class="login loginmodal-submit" value="Login">
            </form>
        </div>
    </div>
</div>
</body>
</html>