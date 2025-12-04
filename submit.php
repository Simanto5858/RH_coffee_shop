<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Start the session to store error/success messages
session_start();

// 1. Include the database connection file
// Assumes that this file contains the database connection variable $conn
require_once "config/config.php";
// 2. Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Processing form submission...";
    // 3. Collect form data and set to null if not present
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $subject = $_POST['subject'] ?? null;
    $message = $_POST['message'] ?? null;
    
    // Array to hold validation errors
    $errors = [];

    // --- Data Validation ---
    
    // Validate Name
    if (empty($name)) {
        $errors['name'] = "Name is required.";
    } elseif (strlen($name) < 3) {
        $errors['name'] = "Name must be at least 3 characters.";
    }

    // Validate Email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate Subject
    if (empty($subject)) {
        $errors['subject'] = "Subject is required.";
    }

    // Validate Message
    if (empty($message)) {
        $errors['message'] = "Message is required.";
    } elseif (strlen($message) < 10) {
        $errors['message'] = "Message must be at least 10 characters.";
    }
    
    // 4. If there are no errors, proceed with database insertion
    if (empty($errors)) {
        
        // --- Database Security (SQL Injection Protection) ---
        // Escape strings to prevent malicious data from compromising the query
        $clean_name = mysqli_real_escape_string($conn, $name);
        $clean_email = mysqli_real_escape_string($conn, $email);
        $clean_subject = mysqli_real_escape_string($conn, $subject);
        $clean_message = mysqli_real_escape_string($conn, $message);
        
        // Get current timestamp
        $current_time = date('Y-m-d H:i:s');
        
        // --- Build the SQL Query ---
        $insert_query = "INSERT INTO contact_messages (name, email, subject, message, created_at) 
                         VALUES ('$clean_name', '$clean_email', '$clean_subject', '$clean_message', '$current_time')";
        
        // Execute the query
        if (mysqli_query($conn, $insert_query)) {
            
            // --- Success Message (Debugging Only) ---
            echo "SUCCESS: Message submitted to DB.";
            header("Location: contact.php"); // এই লাইনগুলো কমেন্ট আউট করে দিন
            exit();
            
        } else {
            // --- Failure Message: SQL ত্রুটি দেখাবে ---
            die("SQL Execution Failed: " . mysqli_error($conn) . "<br>Query: " . $insert_query);
        }
        
    } else {
        die("VALIDATION FAILED! Check the errors array below:<pre>" . print_r($errors, true) . "</pre>");
        // 5. If validation errors exist, send errors and form data back to the contact page
        //$_SESSION['form_errors'] = $errors;
       // $_SESSION['form_data'] = $_POST; // Retain filled data
        //header("Location: contact.php");
        exit();
    }
    
} else {
    // If accessed directly without POST method, redirect to the home page
    header("Location: index.php");
    exit();
}
?>