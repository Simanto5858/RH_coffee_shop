<?php 
// $conn (database connection) and url are defined in header.php
require_once "../layouts/header.php"; 
?>

<?php

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Basic input validation
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('One or more inputs are empty !!')</script>";
        // Script execution stops here if fields are empty
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password_raw = $_POST['password'];

        $errors = []; 
        
        // --- 1. SECURE EMAIL DUPLICATE CHECK (Checking both tables) ---
        // ... (Email duplication check remains the same and secure) ...
        
        // Check 'admins' table
        $stmt_admin = $conn->prepare("SELECT id FROM admins WHERE email = ?");
        $stmt_admin->bind_param("s", $email);
        $stmt_admin->execute();
        $admin_result = $stmt_admin->get_result();

        // Check 'users' table
        $stmt_user = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt_user->bind_param("s", $email);
        $stmt_user->execute();
        $user_result = $stmt_user->get_result();
        
        if ($admin_result->num_rows > 0 || $user_result->num_rows > 0) {
            $errors[] = "This email is already used by another Admin or User.";
        }
        
        $stmt_admin->close();
        $stmt_user->close();


        // --- 2. Error Handling ---
        if (!empty($errors)) {
            $error_message = "Admin creation failed!\\n";
            foreach ($errors as $error) {
                $error_message .= "• " . $error . "\\n";
            }
            echo "<script>alert('" . $error_message . "')</script>";
            echo "<script>window.location.href='" . url . "/admin-panel/admins/create-admins.php'</script>";
            exit();
        }
        
        
        // --- 3. ADMIN CREATION (FIXED: Storing Plain Text Password) ---
        
        // Storing the raw password as requested by the user
        $password_to_store = $password_raw; 
        
        // Inserting Data using Prepared Statement (SQL Injection is still prevented here)
        $insert_query = "INSERT INTO admins (admin_name, email, password) VALUES (?, ?, ?)";
        
        $stmt_insert = $conn->prepare($insert_query);
        // Using $password_to_store (raw password)
        $stmt_insert->bind_param("sss", $name, $email, $password_to_store); 
        
        if ($stmt_insert->execute()) {
            echo "<script>alert('New Admin Added Successfully !!')</script>";
        } else {
            echo "<script>alert('Query failed: Database error.')</script>";
        }
        
        $stmt_insert->close();
        
        // Redirect to the same page
        echo "<script>window.location.href='" . url . "/admin-panel/admins/create-admins.php'</script>";
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Admins</h5>
                    <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                        <div class="form-outline mb-4">
                            <input type="text" name="name" class="form-control" placeholder="name" required />
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="email" name="email" class="form-control" placeholder="email" required />
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="password" class="form-control" placeholder="password" required />
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php 
// Footer include (if applicable)
 require_once "../layouts/footer.php"; 
?>