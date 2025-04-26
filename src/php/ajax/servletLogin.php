<?php  
session_start();  
require 'includes/db.php'; // Make sure this path is correct  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    // Get the JSON input from the AJAX request  
    $input = file_get_contents('php://input');  
    $data = json_decode($input, true); // Decode the JSON data  

    // Check if both username and password are provided  
    if (empty($data['username']) || empty($data['password'])) {  
        echo json_encode(['success' => false, 'message' => 'Username and password are required.']);  
        exit;  
    }  

    // Sanitize input  
    $username = trim($data['username']);  
    $password = trim($data['password']);  
    
    // Query the database for user record  
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");  
    $stmt->bindParam(':username', $username);  
    $stmt->execute();  
    $user = $stmt->fetch(PDO::FETCH_ASSOC);  

    // Check if the user exists and verify password  
    if ($user && password_verify($password, $user['password'])) {  
        $_SESSION['user_id'] = $user['id']; // Store user id in session  
        echo json_encode(['success' => true]); // Login successful  
    } else {  
        echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);  
    }  
} else {  
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);  
}  
?>  