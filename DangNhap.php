<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./Style/DangNhap.css">
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
</head>
<body>
    <?php
        session_start();

        if (isset($_SESSION["username"])) {
            header("Location: TrangChu.php");
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
        <form action="DangNhap.php" method="POST">
            <h1>Đăng nhập</h1>
            <div class="input-box">
                <input type="text" placeholder="Tên đăng nhập" name="TenDN" required>
                <i class="ti-user"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Mật khẩu" name="Pass" required>
                <i class="ti-lock"></i>
            </div>

            <div class="remember-pass">
                <label><input type="checkbox" name="Remember"> Nhớ mật khẩu</label>
                <a href="#">Quên mật khẩu?</a>
            </div>

            <button type="submit">Đăng nhập</button>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $username = $_POST['TenDN'];
                    $password = $_POST['Pass'];
                
                    $sql = "SELECT * FROM user WHERE TenDN = ? AND MatKhau = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();
                
                    if ($result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                        // Lưu tên đăng nhập vào session
                        $_SESSION["username"] = $user['TenDN']; 
                        header("Location: TrangChu.php");
                        exit();
                    } else {
                        echo "<div style='text-align: center;'><b style='color: red;'>Tên đăng nhập hoặc mật khẩu không đúng</b></div>";
                    }
                
                    $stmt->close();
                }
                $conn->close();
            ?>

            <hr style="margin-top: 15px;">

            <div class="register">
                <p>Bạn chưa có tài khoản? <a href="DangKy.php">Tạo tài khoản</a></p>
            </div>
        </form>
    </div>
    <div class="go-to-admin">
        <a href="AdminDangNhap.php">Admin <i class="ti-arrow-circle-right"></i></a>
    </div>
</body>
</html>