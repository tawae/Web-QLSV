<?php
$conn = new mysqli("localhost", "root", "", "web_qlsv");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM sinhvien WHERE id = $id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $hoten = $_POST['hoten'];
    $lop = $_POST['lop'];
    $namsinh = $_POST['namsinh'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];

    $conn->query("UPDATE sinhvien SET 
        hoten='$hoten', lop='$lop', namsinh='$namsinh', email='$email', sdt='$sdt'
        WHERE id = $id");

    header("Location: index.php");
}
?>

<h2>Sửa thông tin sinh viên</h2>
<form method="post">
    <input type="text" name="hoten" value="<?= $row['hoten'] ?>" required>
    <input type="text" name="lop" value="<?= $row['lop'] ?>" required>
    <input type="number" name="namsinh" value="<?= $row['namsinh'] ?>" required>
    <input type="email" name="email" value="<?= $row['email'] ?>" required>
    <input type="text" name="sdt" value="<?= $row['sdt'] ?>" required>
    <button type="submit" name="update">Cập nhật</button>
</form>
<a href="index.php">Quay lại</a>