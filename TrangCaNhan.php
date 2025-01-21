<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Cá Nhân</title>
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./Style/TrangCaNhan.css">
</head>
<body>
    <?php
        session_start();

        $Message = "";

        if (!isset($_SESSION["username"])) {
            header("Location: DangNhap.php");
            exit();
        }
        else
        {
            $conn = new mysqli("localhost", "root", "", "qlbantui");

            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $Username = $_SESSION["username"];

            $sql = "SELECT * FROM user WHERE TenDN = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $Username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) {
                    $TenDN = $row["TenDN"];
                    $HoTen = $row["HoTen"];
                    $Email = $row["Email"];
                    $SDT = $row["SDT"];
                    $DiaChi = $row["DiaChi"];
                }
            } 
            else 
            {
                echo "Lỗi 404.";
                exit();
            }

            if (isset($_POST["Update"]))
            {
                $HoTenS = isset($_POST["HoTen"]) ? $_POST["HoTen"] : "";
                $EmailS = isset($_POST["Email"]) ? $_POST["Email"] : "";
                $SDTS = isset($_POST["SDT"]) ? $_POST["SDT"] : "";
                $DiaChiS = isset($_POST["DiaChi"]) ? $_POST["DiaChi"] : "";
                $TenDNBD = isset($_POST["TenDNBD"]) ? $_POST["TenDNBD"] : "";

                $sql1 = "UPDATE user SET HoTen = ?, Email = ?, SDT = ?, DiaChi = ? WHERE TenDN = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("sssss", $HoTenS, $EmailS, $SDTS, $DiaChiS, $TenDNBD);
                if ($stmt1->execute())
                {
                    $Message = "<div class='success' style='text-align: center; color: green; font-weight: bold; margin-top: 20px;'>Tài khoản của quý khách đã được cập nhật. <a href='TrangCaNhan.php' style='color: blue;'> Vui lòng load lại trang web </a> </div>";
                }
                else
                    echo "Lỗi: " . $stmt2->error;
            }

            if (isset($_POST["LogOut"]))
            {
                session_unset();
                session_destroy();
                header("Location: DangNhap.php");
                exit();
            }

            $conn->close();
        }
    ?>

    <div class="main">
        <!-- HEADER -->
        <div class="header">
            <div class="logo"><a href="TrangChu.php">Túi UNETI</a></div>

            <ul class="nav">
                <li><a href="TrangChu.php">Trang chủ</a></li>
                <li><a href="SanPham.php">Sản phẩm</a></li>
                <li><a href="GioiThieu.php">Giới thiệu</a></li>
                <li><a href="LienHe.php">Liên hệ</a></li>
            </ul>

            <div class="user-function">
                <a class="icon" href="TrangCaNhan.php">
                    <i class="ti-user"></i>
                </a>
                <a class="icon" href="GioHang.php">
                    <i class="ti-shopping-cart"></i>
                </a>
            </div>
        </div>

        <!-- Information -->
        <div class="wrap">
            <div class="information">
                <h1>Trang cá nhân</h1>
                <hr>
                <div class="user-image">
                    <div class="image">
                        <img src="./Image/User.jpg" alt="User">
                    </div>
                </div>
                <form action="" method="post">
                    <div class="username info">
                        <label>Tên đăng nhập: </label>
                        <input type="text" name="TenDN" value="<?php echo $TenDN; ?>" readonly>
                    </div>
                    <div class="fullname info">
                        <label>Họ tên: </label>
                        <input type="text" name="HoTen" value="<?php echo $HoTen; ?>">
                    </div>
                    <div class="email info">
                        <label>Email: </label>
                        <input type="text" name="Email" value="<?php echo $Email; ?>">
                    </div>
                    <div class="phonenum info">
                        <label>Số điện thoại: </label>
                        <input type="text" name="SDT" value="<?php echo $SDT; ?>">
                    </div>
                    <div class="address info">
                        <label>Địa chỉ: </label>
                        <input type="text" name="DiaChi" value="<?php echo $DiaChi; ?>">
                    </div>
                    <?php echo $Message; ?>
                    <div class="btn">
                        <input type="hidden" name="TenDNBD" value="<?php echo $TenDN; ?>">
                        <button class="Update" type="submit" name="Update">Cập nhật</button>
                        <button class="Logout" type="submit" name="LogOut">Đăng xuất</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-about">
                <h2>Thực hành web - Nhóm 13 - DHTI15A9HN</h2>
                <table>
                    <tr style="text-align: center; font-weight: bold;">
                        <td>Họ tên</td>
                        <td>Mã sinh viên</td>
                        <td>Ngày sinh</td>
                    </tr>
                    <tr>
                        <td>Trần Tiến Anh</td>
                        <td>21103100561</td>
                        <td>19/08/2003</td>
                    </tr>
                    <tr>
                        <td>Doãn Nam Khánh</td>
                        <td>21103100593</td>
                        <td>14/08/2003</td>
                        
                    </tr>
                    <tr>
                        <td>Nguyễn Thành Trung</td>
                        <td>21103100488</td>
                        <td>25/10/2003</td>
                    </tr>
                </table>
            </div>
            <div class="footer-contact">
                <div class="fanpage">
                    <h2>Fanpage của chúng tôi</h2>
                    <a href="#" title="Facebook"><i class="icon-facebook ti-facebook"></i></a>
                    <a href="#" title="Instagram"><i class="icon-instagram ti-instagram"></i></a>
                    <a href="#" title="Youtube"><i class="icon-youtube ti-youtube"></i></a>
                    <a href="#" title="Github"><i class="icon-github ti-github"></i></a>
                    <a href="#" title="Linkedin"><i class="icon-linkedin ti-linkedin"></i></a>
                </div>
                <div class="address">
                    <h2>Trường đại học Kinh tế - Kỹ thuật Công nghiệp UNETI</h2>
                    <p><i class="ti-location-pin"></i> Số 218 Đường Lĩnh Nam, Q.Hoàng Mai, TP.Hà Nội</p>
                    <p><i class="ti-mobile"></i> 024.38621504</p>
                    <p><i class="ti-email"></i> web@uneti.edu.vn</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>