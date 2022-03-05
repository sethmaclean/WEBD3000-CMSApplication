<?php require_once('../private/initialize.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Application - Login</title>
</head>

<body>

    <h1>Welcome to the Customer Management Application</h1>
    <h3>Sign In</h3>

    <?php echo display_errors($errors); ?>

    <form action="login.php" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>

    </form>

</body>

</html>