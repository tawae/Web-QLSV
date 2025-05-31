<?php
$conn = new mysqli("localhost", "root", "", "web_qlsv");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tổng số sinh viên
$res1 = $conn->query("SELECT COUNT(*) AS total FROM sinhvien");
$tongSoSinhVien = $res1->fetch_assoc()['total'];

// Trung bình CPA
$res2 = $conn->query("SELECT AVG(cpa) AS avg FROM sinhvien");
$trungBinhCPA = round($res2->fetch_assoc()['avg'], 2);

// Số sinh viên CPA > 3.2
$res3 = $conn->query("SELECT COUNT(*) AS total FROM sinhvien WHERE ROUND(cpa, 1) >= 3.2 and ROUND(cpa, 1) < 3.6");
$soSinhVienHon3_2 = $res3->fetch_assoc()['total'];

$res4 = $conn->query("SELECT COUNT(*) AS total FROM sinhvien WHERE ROUND(cpa, 1) >= 3.6");
$soSinhVienHon3_6 = $res4->fetch_assoc()['total'];

echo json_encode([
    'tongSoSinhVien' => $tongSoSinhVien,
    'trungBinhCPA' => $trungBinhCPA,
    'soSinhVienHon3_2' => $soSinhVienHon3_2,
    'soSinhVienHon3_6' => $soSinhVienHon3_6
]);

$conn->close();
?>