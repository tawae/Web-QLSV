<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Lấy dữ liệu từ form
$name = $_POST['name'];
$pass = $_POST['pass'];

// Kết nối đến MySQL
$conn = new mysqli('localhost', 'root', '', 'web_qlsv');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// Truy vấn kiểm tra tài khoản
$sql = "SELECT * FROM admin WHERE name = ? AND pass = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Đăng nhập thành công
    $_SESSION['name'] = $name;
    header("Location: /web_qlsv/dashmain/index.php");
    exit();
} else {
    echo "Sai tài khoản hoặc mật khẩu";
}
$conn->close();
?>
