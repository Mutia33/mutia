<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
</head>
<body>
    <form action="login.php" method="POst">
        <fieldset>
        <legend>Login</Legend>
        <p>
            <Label>Username:</Label>
            <input type="text" name="username" placeholder="username..." />
        </p>
        <p>
            <label>Password:</Label>
            <input type="password" name="password" placeholder="password..." />
        </p>
        <p>
            <label><input type="checkbox" name="remember" value="remember" /> Remember me</Label>
        </p>
        <p>
            <input type="submit" name="submit" value="Login" />
        </p>
        </fieldset>
    </form>
</body>
</html>