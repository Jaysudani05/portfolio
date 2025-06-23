<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right,rgb(0, 0, 0));
            font-family: 'Poppins', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            animation: slideIn 1s ease-out;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h2 {
            font-size: 36px;
            font-weight: bold;
            color: #FFBD39;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-in-out;
        }

        p {
            font-size: 18px;
            color: #ddd;
            animation: fadeIn 1.5s ease-in-out;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: bold;
            transition: transform 0.3s ease, background-color 0.3s ease;
            animation: fadeInUp 2s ease-in-out;
        }

        .btn-primary {
            background-color: #FFBD39;
            border: none;
            color: #000;
        }

        .btn-primary:hover {
            background-color: #e6a900;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #ff4d4d;
            border: none;
        }

        .btn-danger:hover {
            background-color: #e60000;
            transform: scale(1.05);
        }

        .d-flex {
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
        }

        @keyframes slideIn {
            from {
                transform: translateY(40px);
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

<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <div class="d-flex">
            <a href="view_feedback.php" class="btn btn-primary">View Feedback</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <p>Welcome to the admin dashboard. Use the buttons above to manage the system efficiently.</p>
    </div>
</body>
</html>
