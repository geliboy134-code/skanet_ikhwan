<?php
session_start();
include "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perbaikan query: username='$username' (sebelumnya username='$password')
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        // Berhasil login
        $_SESSION['status'] = "sukses";
        $_SESSION['username'] = $username;
        header('location:index.php');
        exit();
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Background Gradient Animasi Modern */
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: linear-gradient(-45deg, #0f172a, #1e1b4b, #311042, #0f172a);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Container Glassmorphism */
        .login-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .login-icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.88rem;
            margin-bottom: 25px;
        }

        /* Message Alert */
        .alert-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            text-align: left;
        }

        /* Form Fields */
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #3b82f6;
            box-shadow: 0 0 12px rgba(59, 130, 246, 0.4);
        }

        /* Submit Button */
        button[name="login"] {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: #3b82f6;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 5px;
        }

        button[name="login"]:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        button[name="login"]:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-icon">🔐</div>
        <h1>Halaman Login</h1>
        <p class="subtitle">Silakan masuk untuk melanjutkan</p>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                ⚠️ <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username..." required autocomplete="off">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password..." required>
            </div>

            <button type="submit" name="login">Login</button>
        </form>
    </div>

</body>

</html>