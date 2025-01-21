<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="./Style/AdminDangNhap.css">
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
</head>
<body>
    <?php
        session_start();

        if(isset($_SESSION["AdminUsername"]))
        {
            header("Location: AdminQLTX.php");
            exit();
        }

        // Tạo và kết nối CSDL
        $conn = new mysqli("localhost", "root", "", "qlbantui");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }
    ?>
    <div class="wrapper">
        <form action="" method="POST">
            <h1>Admin</h1>
            <div class="input-box">
                <input type="text" placeholder="Tên đăng nhập" name="TenAdmin" required>
                <i class="ti-user"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Mật khẩu" name="MKAdmin" required>
                <i class="ti-lock"></i>
            </div>

            <button type="submit">Đăng nhập</button>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $AdminUsername = $_POST['TenAdmin'];
                    $password = $_POST['MKAdmin'];
                
                    $sql = "SELECT * FROM admin WHERE TenAdmin = ? AND MKAdmin = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $AdminUsername, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                
                    if ($result->num_rows > 0) {
                        $admin = $result->fetch_assoc();

                        $_SESSION["AdminUsername"] = $admin['TenAdmin']; 

                        header("Location: AdminQLTX.php");
                        exit();
                    } else {
                        echo "<div style='text-align: center;'><b style='color: red;'>Tên đăng nhập hoặc mật khẩu không đúng</b></div>";
                    }
                
                    $stmt->close();
                }
                $conn->close();
            ?>
        </form>
    </div>
    <div class="go-to-guest">
        <a href="DangNhap.php"><i class="ti-arrow-circle-left"></i> Khách hàng</a>
    </div>
</body>
</html>