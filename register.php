<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $qualification = $_POST['qualification'];
    $address_1 = $_POST['address_1'];
    $address_2 = $_POST['address_2'];
    $address_3 = $_POST['address_3'];
    $address_4 = $_POST['address_4'];
    $address_5 = $_POST['address_5'];

    $stmt = $conn->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $password, $name);
    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
    <title>www.tamil'slogin.com</title>
</head>
<body class="w-full h-screen flex justify-center items-center bg-sky-200">
    <form class="w-1/2 flex flex-col justify-center items-center gap-5 bg-white opacity-70 rounded shadow-2xl shadow-gray-500" action="register.php" method="POST">
        <h2 class="text-2xl mt-6">User Register</h2>
        <div class="flex justify-between items-center gap-3">
            <input class="w-[250px] h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm "  type="text" name="fname" placeholder="First Name" required>
            <input class="w-[250px] h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="lname" placeholder="Last Name" required>
        </div>
        <input class="w-3/4 h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="email" name="email" placeholder="Email" required>
        <input class="w-3/4 h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="password" name="password" placeholder="Password" required>
        <div class="flex justify-between items-center gap-3">
            <input class="w-[250px] h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="phone" placeholder="Phone Number" required>
            <input class="w-[250px] h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="qualification" placeholder="Qualification" required>
        </div>
        <input class="w-3/4 h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="address_1" placeholder="House no / Apartment Name" required>
        <input class="w-3/4 h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="address_2" placeholder="Street Name / Opposite to" required>
        <input class="w-3/4 h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="address_3" placeholder="City Name" required>
        <input class="w-3/4 h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="address_4" placeholder="District" required>
        <input class="w-3/4 h-8 border p-4 focus:ring-1 ring-pink-500 outline-none rounded-sm"  type="text" name="address_5" placeholder="Pin Code" required>
        <button class="px-7 py-1.5 bg-orange-500 hover:scale-110 transition-all ease-in duration-200 m-5" type="submit">Register</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>
