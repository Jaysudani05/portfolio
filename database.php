<?php 
// database.php - Database connection 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "assignment"; 
 
try { 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, 
$password); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch(PDOException $e) { 
    die("Connection failed: " . $e->getMessage()); 
} 
?>