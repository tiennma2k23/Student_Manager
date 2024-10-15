<?php
include 'config.php';
session_start(); 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mssv = $_POST['mssv'];
    $ho_ten = $_POST['ho_ten'];

    // Chuẩn bị truy vấn với cơ chế prepared statement
    $sql = "INSERT INTO students (mssv, ho_ten) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $mssv, $ho_ten);

    // Thực thi truy vấn và xử lý lỗi
    try {
        $stmt->execute();
        $_SESSION['message'] = "Sinh viên đã được thêm thành công!";
        header("Location: index.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Kiểm tra lỗi trùng MSSV 1062 Exception
        if ($e->getCode() == 1062) {
            $_SESSION['error'] = "Lỗi: MSSV đã tồn tại!";
        } else {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
        header("Location: index.php");
        exit();
    }
}

$conn->close();
?>
