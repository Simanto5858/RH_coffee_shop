<?php require_once "../includes/header.php"; ?>

<?php
// If user is already logged in, redirect them to the index page
if (isset($_SESSION['username'])) {
  echo "<script>window.location.href = '" . url . "/index.php';</script>";
  exit();
}

if (isset($_POST['submit'])) {
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script>alert('One or more inputs are empty !!')</script>";
  } else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password_raw = $_POST['password'];

    $errors = [];

    // --- 1. Removed: Check for Name Duplication ---

    // --- 2. Check for Email Duplication (SECURE: Using Prepared Statements & checking both tables) ---
    
    // Check email in 'users' table
    $check_user_email_query = "SELECT id FROM users WHERE email = ?";
    $stmt_user_email = mysqli_prepare($conn, $check_user_email_query);
    mysqli_stmt_bind_param($stmt_user_email, "s", $email);
    mysqli_stmt_execute($stmt_user_email);
    $user_email_result = mysqli_stmt_get_result($stmt_user_email);

    // Check email in 'admins' table
    $check_admin_email_query = "SELECT id FROM admins WHERE email = ?";
    $stmt_admin_email = mysqli_prepare($conn, $check_admin_email_query);
    mysqli_stmt_bind_param($stmt_admin_email, "s", $email);
    mysqli_stmt_execute($stmt_admin_email);
    $admin_email_result = mysqli_stmt_get_result($stmt_admin_email);

    // Check if the email exists in either table
    if (mysqli_num_rows($user_email_result) > 0 || mysqli_num_rows($admin_email_result) > 0) {
      $errors[] = "This email is already used by another User or Admin.";
    }

    mysqli_stmt_close($stmt_user_email);
    mysqli_stmt_close($stmt_admin_email);

    // --- 3. Error Handling ---
    if (!empty($errors)) {
      $error_message = "Registration failed!\\n";
      foreach ($errors as $error) {
        $error_message .= "• " . $error . "\\n";
      }
      echo "<script>alert('" . $error_message . "')</script>";
      echo "<script>window.location.href='" . url . "/auth/register.php';</script>";
      exit();
    }

    // --- 4. User Creation (SECURE: Using Hashing and Prepared Statements) ---
    $hashed_password = password_hash($password_raw, PASSWORD_DEFAULT);

    $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt_insert, "sss", $name, $email, $hashed_password);

    if (mysqli_stmt_execute($stmt_insert)) {
      // Set session variables upon successful registration
      $user_id = mysqli_insert_id($conn);
      $_SESSION['username'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['user_id'] = $user_id;

      echo "<script>alert('Registered Successfully')</script>";
      echo "<script>window.location.href='" . url . "/index.php';</script>";
    } else {
      echo "<script>alert('Registration failed due to a server error. Please try again.')</script>";
    }

    mysqli_stmt_close($stmt_insert);
  }
}
?>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form action="register.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading">Register</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" id="name" type="text" class="form-control" placeholder="Name" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" id="email" type="email" class="form-control" placeholder="Email" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" id="password" type="password" class="form-control" placeholder="Password" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="login.php" class="">Already Have an Account</a>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <button name="submit" type="submit" class="btn btn-primary py-3 px-4">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once "../includes/footer.php"; ?>