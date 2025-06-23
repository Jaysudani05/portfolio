<?php
session_start();
require_once "database.php";

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    try {
        $stmt = $conn->prepare("DELETE FROM feedback WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error deleting feedback: " . $e->getMessage());
    }
}

header("Location: view_feedback.php");
exit();
