<?php 

require_once "../config/config.php"; 

// সেশন শুরু 
session_start();

// অ্যাডমিন লগইন চেক 
if (!isset($_SESSION['admin_name'])) {
    
    header("Location: " . url . "/admin-panel/admins/login.php");
    exit();
}


if (!isset($_SERVER['HTTP_REFERER'])) {
    echo "<script>window.location.href = '" . ADMINURL . "'</script>";
    exit();
}


if (isset($_GET['id'])) {
    $message_id = mysqli_real_escape_string($conn, $_GET['id']);

    // --- ডিলিট  ---
    $delete_query = "DELETE FROM contact_messages WHERE id = '$message_id'";
    
    //  (সফলতার ক্ষেত্রে)
if (mysqli_query($conn, $delete_query)) {
    
    echo "<script>alert('Message Deleted Successfully!')</script>";
    
    
    echo "<script>window.location.href='" . ADMINURL . "/contact-messages.php'</script>"; 
    
} else {
        // ডিলিট ব্যর্থ হলে
        die("Query Unsuccessful: " . mysqli_error($conn));
    }

} else {
echo "<script>window.location.href='" . ADMINURL . "/contact-messages.php'</script>";}

mysqli_close($conn);
?>