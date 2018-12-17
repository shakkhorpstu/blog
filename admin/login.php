<?php
include_once './database/databasefile.php';

if (isset($_POST['form_login'])) {
    try {
        $password = $_POST['password'];
        $password = md5($password);

        $statement = $db->prepare("SELECT username, password FROM admin_login WHERE username = ? AND password = ?");
        $statement->execute(array($_POST['username'], $password));

        $num = $statement->rowCount();


        if ($num > 0) {
            session_start();
            $_SESSION['name'] = "my_admin";
            header('location: index.php');
        } else {
            throw new Exception("Invalid username or password!");
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>


<html>
    <head>
        <title>Login sample blog</title>
        <link type="text/css" href="admindesign.css" rel="stylesheet">
    </head>

    <body>

        <div id="login">
            <h1>Admin Login</h1>

<?php
if (isset($error_message)) {
    echo "<span class='error'>".$error_message."</span>";
}
?>

            <form action="" method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="Password" name="password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Login" name="form_login"></td>
                    </tr>
                    <table>
                        <form>
                            </div>
                            </body>
                            </html>
