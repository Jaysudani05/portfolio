<?php 
// submit_feedback.php - Handle form submission 
require_once 'database.php'; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Check if all required POST keys exist 
    if (!isset($_POST['name'], $_POST['email'], $_POST['subject'], 
$_POST['message'])) { 
        die("Error: One or more form fields are missing. Please check the form 
submission."); 
    } 
 
    // Sanitize input 
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING); 
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING); 
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING); 
 
    // Validate input 
    if (empty($name) || empty($email) || empty($subject) || empty($message)) { 
        die("Error: All fields are required and cannot be empty."); 
    } 
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        die("Error: Invalid email format."); 
    } 
 
    try { 
        $sql = "INSERT INTO feedback (name, email, subject, message, 
created_at)  
                VALUES (:name, :email, :subject, :message, NOW())"; 
        $stmt = $conn->prepare($sql); 
        $stmt->execute([ 
            ':name' => $name, 
            ':email' => $email, 
            ':subject' => $subject, 
            ':message' => $message 
        ]); 
        header("Location: thank-you.html"); 
        exit(); 
    } catch(PDOException $e) { 
        die("Database error: " . $e->getMessage()); 
    } 
} else { 
    die("Error: Form must be submitted via POST method."); 
} 
?> 