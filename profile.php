<?php
session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./profile.css">
    <title>User Profile</title>
</head>
<body>
    <h2>Welcome , <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p>Email id: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>User Id: <?php echo htmlspecialchars($user['id']); ?></p>
    <p>Phone No: <?php echo htmlspecialchars($user['phone']); ?></p>
    <p>Education Qualification : <?php echo htmlspecialchars($user['qualification']); ?></p>
    <p>User ID: <?php echo htmlspecialchars($user['']); ?></p>
    <p>Status: <?php echo $user['is_admin'] ? 'Admin' : 'User'; ?></p>

    <a href="logout.php">Logout</a>
    <?php if ($_SESSION['is_admin']): ?>
        <br>
        <a href="admin.php">Go to Admin Panel</a>
    <?php endif; ?>
</body>
</html>
