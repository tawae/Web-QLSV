<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Thông tin kết nối CSDL
$servername = "localhost";
$username = "root"; 
$password = "";      
$dbname = "web_qlsv";   

// Lấy dữ liệu từ form
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$note = $_POST['note'];

// Kết nối đến MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Chèn dữ liệu
$sql = "INSERT INTO info (name, email, tel, note) VALUES ('$name', '$email', '$tel', '$note')";

if ($conn->query($sql) === TRUE) {
    echo "Luu thanh cong!<br>";
    echo "Tên: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "SĐT: " . $tel . "<br>";
    echo "Ghi chú: " . $note . "<br>";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
