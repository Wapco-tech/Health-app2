<?php  
// Set header to return JSON  
header('Content-Type: application/json');  

session_start(); // Start session to store verification data  
require 'includes/db.php'; // Adjust path if needed relative to this file's location  

$response = ['success' => false, 'message' => 'Invalid request.']; // Default response  

// Check if it's a POST request  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    // Get the raw JSON data from the request body  
    $inputJSON = file_get_contents('php://input');  
    $input = json_decode($inputJSON, TRUE); // Decode JSON into an associative array  

    // --- Server-side Validation ---  
    $username = trim($input['username'] ?? '');  
    $phone = trim($input['phone'] ?? '');  
    $email = trim($input['email'] ?? '');  
    // $password = $input['password'] ?? ''; // If you add password  

    if (empty($username) || empty($phone) || empty($email)) {  
        $response['message'] = 'All fields (Username, Phone, Email) are required.';  
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
        $response['message'] = 'Invalid email format.';  
    } elseif (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) { // Example phone validation (adjust regex)  
        $response['message'] = 'Invalid phone number format.';  
    // } elseif (empty($password) || strlen($password) < 8) { // If using password  
        // $response['message'] = 'Password must be at least 8 characters long.';  
    } else {  
        // --- Check for existing user (Example - adjust query as needed) ---  
        try {  
            $stmt_check = $db->prepare("SELECT id FROM users WHERE phone = :phone OR email = :email");  
            $stmt_check->bindParam(':phone', $phone);  
            $stmt_check->bindParam(':email', $email);  
            $stmt_check->execute();  

            if ($stmt_check->fetch()) {  
                $response['message'] = 'Phone number or email already registered.';  
            } else {  
                // --- All checks passed, proceed to insert ---  

                // Hash password if using one  
                // $hashed_password = password_hash($password, PASSWORD_DEFAULT);  

                // Prepare INSERT statement  
                // Add password column and parameter if needed  
                $stmt_insert = $db->prepare("INSERT INTO users (username, phone, email, registration_status) VALUES (:username, :phone, :email, 'pending')");  
                $stmt_insert->bindParam(':username', $username);  
                $stmt_insert->bindParam(':phone', $phone);  
                $stmt_insert->bindParam(':email', $email);  
                // $stmt_insert->bindParam(':password', $hashed_password); // If using password  

                if ($stmt_insert->execute()) {  
                    // --- User inserted, now handle verification code ---  

                    $verification_code = rand(100000, 999999); // Generate a 6-digit code  

                    // Store code and relevant info in session (or database) for verification later  
                    $_SESSION['verification_code'] = $verification_code;  
                    $_SESSION['verification_phone'] = $phone; // Store phone to know who is verifying  
                    $_SESSION['verification_email'] = $email; // Store email as well  
                    $_SESSION['verification_time'] = time(); // Store time for expiry check  

                    // **************************************************  
                    // *** SEND VERIFICATION CODE HERE ***  
                    // This is where you integrate with an SMS gateway API (like Twilio, Nexmo)  
                    // or an email service to send the $verification_code to $phone or $email.  
                    // Example (conceptual - replace with actual API call):  
                    // sendSMS($phone, "Your verification code is: " . $verification_code);  
                    // OR  
                    // sendEmail($email, "Verification Code", "Your code is: " . $verification_code);  
                    // **************************************************  

                    // IMPORTANT: Check if the code was sent successfully by your service.  
                    // If sending fails, you might want to roll back the user insertion or mark them differently.  
                    // For simplicity here, we assume sending works.  

                    $response['success'] = true;  
                    $response['message'] = 'Registration successful. Verification code sent.'; // Message for debugging/logging if needed  

                } else {  
                    $response['message'] = 'Database error during registration. Please try again.';  
                    // Log detailed error: $stmt_insert->errorInfo()  
                }  
            }  
        } catch (PDOException $e) {  
            $response['message'] = 'Database connection error: ' . $e->getMessage(); // More specific error for debugging  
             // Log the full error $e  
        }  
    }  
}  

// Send the JSON response back to the JavaScript AJAX call  
echo json_encode($response);  
exit; // Terminate script after sending JSON  
?>  