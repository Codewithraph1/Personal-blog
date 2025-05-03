<?php
// admin/register.php
include_once __DIR__ . '/../include/connect.php';

$message = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        $message = "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO admin_users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $message = "Admin Registered Successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
</head>
<body>
    <h2>Admin Register</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="password" name="cpassword" placeholder="Confirm Password" required><br><br>
        <button type="submit" name="register">Register</button>
    </form>

    <p style="color:red;"><?php echo $message; ?></p>

    <p>Already have an account? <a href="login">Login here</a></p>
</body>
</html>
