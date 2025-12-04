<?php require_once "../includes/header.php"; ?>
<?php
// If user OR admin is already logged in, redirect them
if (isset($_SESSION['username']) || isset($_SESSION['admin_name'])) {
  // If an admin is logged in, prioritize redirecting them to the admin panel base
  if (isset($_SESSION['admin_name'])) {
     // Using JavaScript for redirection
     echo "<script>window.location.href = '" . url . "/admin-panel';</script>"; 
     exit();
  }
  // Otherwise, redirect to the user index page
  echo "<script>window.location.href = '" . url . "/index.php';</script>";
  exit();
}

if (isset($_POST['submit'])) {
  if (empty($_POST['email']) or empty($_POST['password'])) {
    echo "<script>alert('email or password are empty !!')</script>";
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $logged_in = false;

    // 1. Check for Admin Login (SECURE: Using Prepared Statements)
    $query_admin = "SELECT id, admin_name, email, password FROM admins WHERE email = ?";
    $stmt_admin = mysqli_prepare($conn, $query_admin);
    mysqli_stmt_bind_param($stmt_admin, "s", $email);
    mysqli_stmt_execute($stmt_admin);
    $result_admin = mysqli_stmt_get_result($stmt_admin);

    if (mysqli_num_rows($result_admin) > 0) {
      if ($row = mysqli_fetch_assoc($result_admin)) {
        // FIXED FOR ADMIN: Direct comparison of plain text passwords
        if ($row['password'] === $password) { 
          // session start for admin
          $_SESSION['admin_name'] = $row['admin_name'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['admin_id'] = $row['id'];
          $logged_in = true;
          
          echo "<script>window.location.href = '" . url . "/admin-panel';</script>";
          exit();
        }
      }
    }
    mysqli_stmt_close($stmt_admin);


    // 2. If not logged in as Admin, Check for User Login (SECURE: Using Prepared Statements & Hashing)
    if (!$logged_in) {
      $query_user = "SELECT id, username, email, password FROM users WHERE email = ?";
      $stmt_user = mysqli_prepare($conn, $query_user);
      mysqli_stmt_bind_param($stmt_user, "s", $email);
      mysqli_stmt_execute($stmt_user);
      $result_user = mysqli_stmt_get_result($stmt_user);


      if (mysqli_num_rows($result_user) > 0) {
        if ($row = mysqli_fetch_assoc($result_user)) {
          // KEPT SECURE: Verifying the user password hash
          if (password_verify($password, $row['password'])) {
            // session start for user
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            $logged_in = true;
            
            echo "<script>alert('Logged in Successfully')</script>";
            echo "<script>window.location.href = '" . url . "/index.php';</script>";
            exit();
          }
        }
      }
      mysqli_stmt_close($stmt_user);
    }
    
    // 3. If neither Admin nor User login succeeded
    if (!$logged_in) {
      echo "<script>alert('email or password is incorrect !!')</script>";
    }
  }
}
?>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form action="login.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading">Login</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" id="email" type="text" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" id="password" type="password" class="form-control" placeholder="Password" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="forgot-password.php" class="">Forgot Password |</a>
                            <a href="register.php" class="">Don't have an Account</a>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <button name="submit" class="btn btn-primary py-3 px-4">Login</button>
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