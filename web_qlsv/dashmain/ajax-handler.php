<?php
$conn = new mysqli("localhost", "root", "", "web_qlsv");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    $ngaysinh = $_POST['ngaysinh'];
    $mail = $_POST['mail'];
    $sdt = $_POST['sdt'];
    $nganh = $_POST['nganh'];
    $lop = $_POST['lop'];
    $cpa = $_POST['cpa'];

    if (isset($_POST['isEdit'])) {
        // Sửa
        $sql = "UPDATE sinhvien SET ten='$ten', ngaysinh='$ngaysinh', mail='$mail',
                sdt='$sdt', nganh='$nganh', lop='$lop', cpa='$cpa' WHERE id='$id'";
    } else {
        // Thêm
        $sql = "INSERT INTO sinhvien (id, ten, ngaysinh, mail, sdt, nganh, lop, cpa)
                VALUES ('$id', '$ten', '$ngaysinh', '$mail', '$sdt', '$nganh', '$lop', '$cpa')";
    }

    if ($conn->query($sql)) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}
