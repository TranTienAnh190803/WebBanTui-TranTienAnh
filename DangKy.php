<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./Style/DangKy.css">
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
</head>
<body>
    <?php
        session_start();

        if (isset($_SESSION["username"])) {
            header("Location: TrangChu.php");
            exit();
        }

        $conn = new mysqli("localhost", "root", "", "qlbantui");

        if ($conn->connect_error)
        {
            die("Kết nối thất bại: " .$conn->connect_error);
        }

        $message = "";
    ?>

    <div class="wrapper">
        <form action="" method="POST">
            <h1>Đăng ký</h1>
            <div class="input-box">
                <input type="text" placeholder="Họ tên" name="HoTen" required>
                <i class="ti-user"></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Tên đăng nhập" name="TenDN" required>
                <i class="ti-user"></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email" name="Email" required>
                <i class="ti-email"></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Số điện thoại" name="SDT" required>
                <i class="ti-mobile"></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Địa chỉ" name="DiaChi" required>
                <i class="ti-location-pin"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Mật khẩu" name="Pass" required>
                <i class="ti-lock"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Nhập lại mật khẩu" name="ConfirmPass" required>
                <i class="ti-lock"></i>
            </div>


            <div class="check"><label><input type="checkbox" name="Confirm" required> Tôi xin xác nhận những thông tin tôi cung cấp là chính xác</label></div>
            

            <button type="submit">Đăng ký</button>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $HoTen = $_POST["HoTen"];
                    $TenDN = $_POST["TenDN"];
                    $Email = $_POST["Email"];
                    $SDT = $_POST["SDT"];
                    $DiaChi = $_POST["DiaChi"];
                    $MatKhau = $_POST["Pass"];
                    $MatKhauNhapLai = $_POST["ConfirmPass"];

                    if ($MatKhau != $MatKhauNhapLai)
                    {
                        $message = "<div style='margin-top: -5px; text-align: center;'><b style='color: red;'>Mật khẩu nhập lại phải khớp với mật khẩu mà quý khách đã nhập</b></div>";
                    }
                    else
                    {
                        $sql1 = "SELECT * FROM user WHERE TenDN = ?";
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->bind_param("s", $TenDN);
                        $stmt1->execute();
                        $result1 = $stmt1->get_result();

                        if ($result1->num_rows > 0)
                        {
                            $message = "<div style='margin-top: -5px; text-align: center;'><b style='color: red;'>Tên tài khoản mà quý khách nhập đã có người sử dụng</b></div>";
                        }
                        else
                        {
                            $sql2 = "INSERT INTO user VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt2 = $conn->prepare($sql2);
                            $stmt2->bind_param("ssssss", $TenDN, $HoTen, $Email, $SDT, $DiaChi, $MatKhauNhapLai);
                            if ($stmt2->execute())
                            {
                                $_SESSION["username"] = $TenDN;
                                header("Location: TrangChu.php");
                                exit();
                            }
                            else
                            {
                                echo "Lỗi: " . $stmt->error;
                            }
                        }
                    }
                }
                echo $message;
            ?>

            <hr style="margin-top: 10px;">

            <div class="login">
                <p>Bạn đã có tài khoản? <a href="DangNhap.php">Đăng nhập</a></p>
            </div>
        </form>
    </div>
</body>
</html>