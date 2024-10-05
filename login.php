<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['is_admin'] = $user['is_admin'];

            header("Location: profile.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>www.tamil'slogin.com</title>
</head>
<body class="w-full h-screen flex bg-pink-200">
    <form class="w-1/2 h-1/2 mx-auto my-auto flex flex-col justify-center items-center gap-5 bg-white opacity-70 rounded shadow-2xl shadow-gray-500" action="login.php" method="POST">
        <h2 class="text-2xl">User Login</h2>
        <input class="w-3/4 h-10 border p-6 focus:ring-1 ring-pink-500 outline-none rounded-sm" type="email" name="email" placeholder="Enter Email Id" required>
        <input class="w-3/4 h-10 border p-6 focus:ring-1 ring-pink-500 outline-none rounded-sm" type="password" name="password" placeholder="Enter Password" required>
        <button class="px-7 py-1.5 bg-orange-500 hover:scale-110 transition-all ease-in duration-200" type="submit">Login</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <p>Don't have an account? <a class="hover:text-blue-500 ml-3" href="./register.php">Register here</a>.</p>
    </form>
</body>
<!--CREATE TABLE Users ( id INT AUTO_INCREMENT PRIMARY KEY, fname VARCHAR(50) NOT NULL, lname VARCHAR(50) N
OT NULL, phone VARCHAR(15) NOT NULL, qualification VARCHAR(100), address_1 VARCHAR(255), address_2 VARCHAR(255
), address_3 VARCHAR(255), address_4 VARCHAR(255), address_5 VARCHAR(255), is_admin TINYINT(1) DEFAULT 0, crea
ted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);-->
</html>



