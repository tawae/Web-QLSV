
<?php
$conn = new mysqli("localhost", "root", "", "web_qlsv");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);
    
    if ($conn->query("DELETE FROM sinhvien WHERE id = '$id'") === TRUE) {
        echo "success";
    } else {
        echo "Lỗi xóa sinh viên: " . $conn->error;
    }
} else {
    echo "Không có ID sinh viên";
}

$conn->close();
?>