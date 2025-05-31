<?php
$conn = new mysqli("localhost", "root", "", "web_qlsv");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort_column = isset($_GET['sort_column']) ? (int)$_GET['sort_column'] : 0;
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

// Mapping column numbers to database fields
$columns = ['ten', 'id', 'ngaysinh', 'mail', 'sdt', 'nganh', 'lop', 'cpa'];
$order_field = $columns[$sort_column] ?? 'ten';

// Build SQL query
$sql = "SELECT * FROM sinhvien";
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " WHERE ten LIKE '%$search%' OR id LIKE '%$search%' OR mail LIKE '%$search%' OR sdt LIKE '%$search%' OR nganh LIKE '%$search%' OR lop LIKE '%$search%'";
}
$sql .= " ORDER BY $order_field $sort_order";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ten']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ngaysinh']) . "</td>";
        echo "<td>" . htmlspecialchars($row['mail']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sdt']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nganh']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lop']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cpa']) . "</td>";
        echo "<td>";
        echo "<button class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Sửa</button> | ";
        echo "<button class='btn btn-sm btn-danger' onclick='deleteStudent(\"" . $row['id'] . "\")'>Xóa</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9' class='text-center'>Không tìm thấy sinh viên nào</td></tr>";
}

$conn->close();
?>