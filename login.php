<?php
session_start();
require 'Database.php';
require 'User.php';

$db = (new Database())->connect();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userInfo = $user->login($email, $password);

    if ($userInfo) {
        $_SESSION['user_id'] = $userInfo['id'];
        header("Location: profile.php");
    } else {
        echo "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>