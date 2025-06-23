<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #000000, #1c1c1c);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            animation: slideIn 1s ease-out;
            width: 100%;
            max-width: 450px;
        }

        h2 {
            text-align: center;
            font-size: 32px;
            color: #FFBD39;
            font-weight: 700;
            margin-bottom: 30px;
            animation: fadeInDown 1s ease-in-out;
        }

        label {
            font-weight: 500;
        }

        .form-control {
            background-color: rgba(255,255,255,0.1);
            border: 1px solid #555;
            color: #fff;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            background-color: rgba(255,255,255,0.15);
            border-color: #FFBD39;
            box-shadow: 0 0 0 0.2rem rgba(255, 189, 57, 0.25);
        }

        .btn-primary {
            background-color: #FFBD39;
            border: none;
            font-weight: bold;
            color: #000;
            padding: 12px;
            border-radius: 30px;
            transition: transform 0.3s ease, background-color 0.3s ease;
            animation: fadeInUp 2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #e6aa30;
            transform: scale(1.05);
        }

        .alert {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="POST">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-primary w-100">
            </div>
        </form>
        <?php
        session_start();
        require_once "database.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $password = $_POST['password'];

            $admin_username = "admin";
            $admin_password = "admin123";

            if ($username === $admin_username && $password === $admin_password) {
                $_SESSION['admin_logged_in'] = true;
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo '<div class="alert alert-danger text-center mt-3">Invalid username or password.</div>';
            }
        }
        ?>
    </div>
</body>
</html>
