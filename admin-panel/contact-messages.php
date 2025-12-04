<?php 
require_once "../config/config.php"; 
require_once "layouts/header.php"; 
?>

<?php
// If admin is not logged in, redirect to the login page
if (!isset($_SESSION['admin_name'])) {
    header("Location: " . url . "/admin-panel/admins/login.php");
    exit();
}

// Fetch all messages, newest first
$contact_message_query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$contact_message_result = mysqli_query($conn, $contact_message_query);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mt-4">✉️ All Contact Messages</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message Preview</th>
                            <th>Received At</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($contact_message_result) > 0): ?>
                            <?php while($contact_messages = mysqli_fetch_assoc($contact_message_result)): ?>
                            <tr>
                                <td><?php echo $contact_messages['id']; ?></td>
                                <td><?php echo htmlspecialchars($contact_messages['name']); ?></td>
                                <td><?php echo htmlspecialchars($contact_messages['email']); ?></td>
                                <td><?php echo htmlspecialchars($contact_messages['subject']); ?></td>
                                <td>
                                    <?php echo nl2br(htmlspecialchars(substr($contact_messages['message'], 0, 80))); ?>...
                                </td> 
                                <td><?php echo date('M d, Y h:i A', strtotime($contact_messages['created_at'])); ?></td>
                                
                                <td>
                                    <a href="delete-message.php?id=<?php echo $contact_messages['id']; ?>" class="btn btn-danger btn-sm text-center" 
                                       onclick="return confirm('Are you sure you want to delete this message?');">
                                        Delete
                                    </a>
                                </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No messages received yet.</td> </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

