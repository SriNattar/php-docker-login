<?php
session_start();
require_once __DIR__ . '/db.php';

$loginError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $loginError = 'Please provide username and password.';
    } else {
        $stmt = $conn->prepare('SELECT id, username, password_hash FROM users WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /');
            exit;
        } else {
            $loginError = 'Invalid credentials.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .login-card{
            background:#fff;
            width:350px;
            padding:40px;
            border-radius:10px;
            box-shadow:0 15px 35px rgba(0,0,0,0.2);
            text-align:center;
        }

        .login-card h2{
            margin-bottom:25px;
            color:#333;
        }

        .input-group{
            margin-bottom:20px;
            text-align:left;
        }

        .input-group label{
            font-size:14px;
            color:#555;
        }

        .input-group input{
            width:100%;
            padding:10px;
            margin-top:5px;
            border-radius:5px;
            border:1px solid #ccc;
            outline:none;
            transition:0.3s;
        }

        .input-group input:focus{
            border-color:#667eea;
        }

        .btn{
            width:100%;
            padding:12px;
            border:none;
            border-radius:5px;
            background:#667eea;
            color:#fff;
            font-size:16px;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            background:#5a67d8;
        }

        .footer{
            margin-top:15px;
            font-size:12px;
            color:#888;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Welcome Back 👋</h2>
    <?php if ($loginError): ?>
        <div style="color:#b00020;margin-bottom:12px;"><?php echo htmlspecialchars($loginError); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button class="btn" type="submit">Login</button>
    </form>

    <div class="footer">
        Secure Login System
    </div>
</div>

</body>
</html>
