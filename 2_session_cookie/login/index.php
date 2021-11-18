<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <form method="POST" action="/week02/login/do_login.php">
        <h2>Login</h2>
        <label>Login: <input type="text" name="login"></label>
        <label>Pass: <input type="password" name="password"></label>
        <input type="submit" name="do_login" value="Inloggen">
    </form>

    <form method="POST" action="/week02/login/do_login.php">
        <h2>Register</h2>
        <label>Voornaam: <input type="text" name="firstname"></label>
        <label>Naam: <input type="text" name="lastname"></label>
        <label>Login: <input type="text" name="login"></label>
        <label>Pass: <input type="password" name="password"></label>
        <input type="submit" name="do_login" value="Inloggen">
    </form>

   
</body>
</html>