<?php
ob_start(); // Bật output buffering
session_start();
if (!isset($_SESSION['name'])) {
  // Nếu chưa đăng nhập, chuyển về trang login
  header("Location: /web_qlsv/login.html");
  exit();
}
// Kết nối CSDL
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

// Thêm sinh viên
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    
    $ngaysinh = $_POST['ngaysinh'];
    $mail = $_POST['mail'];
    $sdt = $_POST['sdt'];
    $nganh = $_POST['nganh'];
    $lop = $_POST['lop'];
    $cpa = $_POST['cpa'];
    $sqlAdd = "INSERT INTO sinhvien VALUES ('$id', '$ten', '$ngaysinh', '$mail', '$sdt', '$nganh', '$lop', '$cpa')"; 
    if ($conn->error) {
        die("Lỗi thêm sinh viên: " . $conn->error);
    }
    $conn->query($sqlAdd);
}

// Lấy danh sách sinh viên
$result = $conn->query("SELECT * FROM sinhvien");
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Quản lý sinh viên</title>
        <link href="css/styles.css" rel="stylesheet"/>
        <link rel="preload" href="css/styles.css" as="style">
        <link rel="preconnect" href="https://fonts[.]googleapis[.]com">
        <link rel="preload" href="css/styles.css" as="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
            <img class="navbar-brand ps-3" href="index.php" src="/web_qlsv/assets/img/navbar-logo.svg"/>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
            <div id="layoutSidenav_content" style="margin-top: 56px;">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Quản lý sinh viên</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Tổng số sinh viên</div>
                                    <h2 class="card-body" ><?= $tongSoSinhVien ?></h2>

                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Điểm TB toàn học viện</div>
                                    <h2 class="card-body"><?= $trungBinhCPA ?></h2>

                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Số sinh viên loại giỏi</div>
                                    <h2 class="card-body"><?= $soSinhVienHon3_2 ?></h2>

                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">Số sinh viên loại xuất sắc</div>
                                    <h2 class="card-body"><?= $soSinhVienHon3_6 ?></h2>

                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Danh sách sinh viên
                                <!-- Search box và nút thêm -->
                                <div class="d-flex justify-content-between mb-2 mt-2">
                                    <div class="search-container">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm sinh viên..." style="width: 300px;">
                                    </div>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#addModal">
                                        ＋ Thêm sinh viên
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="studentTable">
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable(0)" style="cursor: pointer;">Họ tên <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(1)" style="cursor: pointer;">Mã sinh viên <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(2)" style="cursor: pointer;">Ngày sinh <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(3)" style="cursor: pointer;">Mail <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(4)" style="cursor: pointer;">SĐT <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(5)" style="cursor: pointer;">Ngành <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(6)" style="cursor: pointer;">Lớp <i class="fas fa-sort"></i></th>
                                            <th onclick="sortTable(7)" style="cursor: pointer;">CPA <i class="fas fa-sort"></i></th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentTableBody">
                                        <!-- Dữ liệu sẽ được load qua Ajax -->
                                    </tbody>
                                </table>
                                <div id="loadingMessage" style="display: none;">Đang tải dữ liệu...</div>
                                <div id="noDataMessage" style="display: none;">Không tìm thấy sinh viên nào.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Thêm sinh viên</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="ten" class="form-control mb-2" placeholder="Họ tên" required>
                                <input type="text" name="id" class="form-control mb-2" placeholder="Mã sinh viên" required>
                                <input type="date" name="ngaysinh" class="form-control mb-2" required>
                                <input type="email" name="mail" class="form-control mb-2" placeholder="Email" required>
                                <input type="text" name="sdt" class="form-control mb-2" placeholder="Số điện thoại" required>
                                <input type="text" name="nganh" class="form-control mb-2" placeholder="Ngành" required>
                                <input type="text" name="lop" class="form-control mb-2" placeholder="Lớp" required>
                                <input type="number" step="0.1" name="cpa" class="form-control mb-2" placeholder="CPA" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="add" class="btn btn-success">Thêm</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    // Reset lại kết quả để lặp lần 2
                    $result = $conn->query("SELECT * FROM sinhvien");
                    while ($row = $result->fetch_assoc()):
                    ?>
                    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="modal-content edit-form" data-id="<?= $row['id'] ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title">Sửa sinh viên <?= $row['id'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" placeholder="Mã sinh viên" required>
                                    <input type="text" name="ten" value="<?= $row['ten'] ?>" class="form-control mb-2" placeholder="Họ và tên" required>
                                    <input type="date" name="ngaysinh" value="<?= $row['ngaysinh'] ?>" class="form-control mb-2" required>
                                    <input type="email" name="mail" value="<?= $row['mail'] ?>" class="form-control mb-2" placeholder="Email" required>
                                    <input type="text" name="sdt" value="<?= $row['sdt'] ?>" class="form-control mb-2" placeholder="Số điện thoại" required>
                                    <input type="text" name="nganh" value="<?= $row['nganh'] ?>" class="form-control mb-2" placeholder="Ngành" required>
                                    <input type="text" name="lop" value="<?= $row['lop'] ?>" class="form-control mb-2" placeholder="Lớp" required>
                                    <input type="number" name="cpa" value="<?= $row['cpa'] ?>" step="0.1" class="form-control mb-2" placeholder="CPA' required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Nguyễn Đức Trung 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
        <script>
    let currentSortColumn = 0;
    let currentSortOrder = 'ASC';

    // Load dữ liệu ban đầu
    document.addEventListener('DOMContentLoaded', () => {
        loadStudents();
        loadStats(); // Load thống kê ban đầu
        
        // Search functionality
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                loadStudents();
            }, 300);
        });

        // Add form AJAX
        document.querySelector('#addModal form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('ajax-handler.php', {
                method: 'POST',
                body: formData
            }).then(res => res.text())
            .then(data => {
                if (data.includes('success')) {
                    alert('Đã thêm thành công');
                    loadStudents(); // Reload table
                    loadStats(); // Reload statistics
                    bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
                    this.reset(); // Clear form
                } else {
                    alert('Lỗi: ' + data);
                }
            });
        });

        // Edit form AJAX
        document.querySelectorAll('.edit-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('isEdit', true);
                fetch('ajax-handler.php', {
                    method: 'POST',
                    body: formData
                }).then(res => res.text())
                .then(data => {
                    if (data.includes('success')) {
                        alert('Đã sửa thành công');
                        loadStudents(); // Reload table
                        loadStats(); // Reload statistics
                        bootstrap.Modal.getInstance(this.closest('.modal')).hide();
                    } else {
                        alert('Lỗi: ' + data);
                    }
                });
            });
        });
    });

    // Function to load students data
    function loadStudents() {
        const searchValue = document.getElementById('searchInput').value;
        const url = `load_students.php?search=${encodeURIComponent(searchValue)}&sort_column=${currentSortColumn}&sort_order=${currentSortOrder}`;
        
        document.getElementById('loadingMessage').style.display = 'block';
        
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('studentTableBody').innerHTML = data;
                document.getElementById('loadingMessage').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loadingMessage').style.display = 'none';
                document.getElementById('studentTableBody').innerHTML = '<tr><td colspan="9" class="text-center text-danger">Lỗi khi tải dữ liệu</td></tr>';
            });
    }

    // Function to load statistics
    function loadStats() {
        fetch('load_stats.php')
            .then(response => response.json())
            .then(data => {
                // Update các card thống kê
                document.querySelector('.col-xl-3:nth-child(1) h2').textContent = data.tongSoSinhVien;
                document.querySelector('.col-xl-3:nth-child(2) h2').textContent = data.trungBinhCPA;
                document.querySelector('.col-xl-3:nth-child(3) h2').textContent = data.soSinhVienHon3_2;
                document.querySelector('.col-xl-3:nth-child(4) h2').textContent = data.soSinhVienHon3_6;
            })
            .catch(error => {
                console.error('Error loading stats:', error);
            });
    }

    // Function to delete student
    function deleteStudent(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sinh viên này?')) {
            const formData = new FormData();
            formData.append('id', id);
            
            fetch('delete_student.php', {
                method: 'POST',
                body: formData
            }).then(res => res.text())
            .then(data => {
                if (data.includes('success')) {
                    alert('Đã xóa thành công');
                    loadStudents(); // Reload table
                    loadStats(); // Reload statistics
                } else {
                    alert('Lỗi: ' + data);
                }
            });
        }
    }

    // Sort function
    function sortTable(columnIndex) {
        if (currentSortColumn === columnIndex) {
            currentSortOrder = currentSortOrder === 'ASC' ? 'DESC' : 'ASC';
        } else {
            currentSortColumn = columnIndex;
            currentSortOrder = 'ASC';
        }
        
        updateSortIcons(columnIndex, currentSortOrder);
        loadStudents();
    }

    // Update sort icons
    function updateSortIcons(activeColumn, order) {
        document.querySelectorAll('th i').forEach(icon => {
            icon.className = 'fas fa-sort';
        });
        
        const activeIcon = document.querySelector(`th:nth-child(${activeColumn + 1}) i`);
        if (activeIcon) {
            activeIcon.className = order === 'ASC' ? 'fas fa-sort-up' : 'fas fa-sort-down';
        }
    }
</script>
    </body>
</html>