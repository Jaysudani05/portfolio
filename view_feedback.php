<?php
session_start();
require_once "database.php";

// Redirect if not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Handle deletion if a POST request is sent
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    try {
        $stmt = $conn->prepare("DELETE FROM feedback WHERE id = :id");
        $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $stmt->execute();
        $successMessage = "Feedback ID $delete_id deleted successfully.";
    } catch (PDOException $e) {
        $errorMessage = "Error deleting feedback: " . $e->getMessage();
    }
}

// Fetch feedback data
try {
    $sql = "SELECT * FROM feedback ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #FFBD39;
            --secondary-color: #f8f9fa;
            --background-color: #000;
            --text-color: #333;
            --hover-bg: #f2f1f1;
            --border-radius: 10px;
            --transition-speed: 0.3s;
        }
        body {
            background-color: var(--background-color);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h2.text-center {
            margin-bottom: 30px;
            color: white;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }
        .btn-primary:hover {
            background-color: rgba(255, 189, 57, 0.66);
        }
        .btn-danger:hover {
            background-color: #dc3545cc;
        }
        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 4px 12px rgb(0, 0, 0,0.1);
        }
        .table th {
            color: black;
            text-align: center;
        }
        .table td, .table th {
            vertical-align: middle;
            padding: 12px;
             background-color: var(--hover-bg);
        }
         .table tbody tr:hover {
            background-color: var(--hover-bg);
        } 
        .container {
            max-width: 960px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Feedback Details</h2>

    <a href="admin_dashboard.php" class="btn btn-primary mb-3">Back to Dashboard</a>

    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success"><?= $successMessage ?></div>
    <?php elseif (!empty($errorMessage)): ?>
        <div class="alert alert-danger"><?= $errorMessage ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Submitted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($feedbacks): ?>
                <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td><?= htmlspecialchars($feedback['id']) ?></td>
                        <td><?= htmlspecialchars($feedback['name']) ?></td>
                        <td><?= htmlspecialchars($feedback['email']) ?></td>
                        <td><?= htmlspecialchars($feedback['subject']) ?></td>
                        <td><?= htmlspecialchars($feedback['message']) ?></td>
                        <td><?= htmlspecialchars($feedback['created_at']) ?></td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Delete this feedback?');">
                                <input type="hidden" name="delete_id" value="<?= $feedback['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No feedback found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
