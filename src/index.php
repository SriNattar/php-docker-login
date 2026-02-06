<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login Successful";
    } else {
        echo "Invalid Credentials";
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username" /><br>
    Password: <input type="password" name="password" /><br>
    <button type="submit">Login</button>
</form>
