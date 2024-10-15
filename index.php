<?php
include 'config.php';
session_start();

// Lấy danh sách sinh viên từ MySQL
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
</head>
<body>

    <!-- Hiển thị thông báo thành công hoặc lỗi -->
    <?php if (isset($_SESSION['message'])): ?>
        <p style="color: green;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <h1>Thêm Sinh Viên</h1>
    <form action="add_student.php" method="POST">
        <label for="mssv">MSSV:</label>
        <input type="text" name="mssv" id="mssv" required>
        <br>
        <label for="ho_ten">Họ tên:</label>
        <input type="text" name="ho_ten" id="ho_ten" required>
        <br>
        <button type="submit">Thêm Sinh Viên</button>
    </form>

    <h2>Danh sách sinh viên</h2>
    <table border="1">
        <tr>
            <th>MSSV</th>
            <th>Họ tên</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["mssv"] . "</td><td>" . $row["ho_ten"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Chưa có sinh viên nào</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>
