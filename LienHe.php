<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi phản hồi</title>
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./Style/LienHe.css">
</head>
<body>
    <?php
        $Message = "";
        if (isset($_POST["send"]))
        {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $HoTen = isset($_POST['HoTen']) ? $_POST['HoTen'] : '';
            $SDT = isset($_POST['SDT']) ? $_POST['SDT'] : '';
            $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
            $TieuDe = isset($_POST['TieuDe']) ? $_POST['TieuDe'] : '';
            $NoiDung = isset($_POST['NoiDung']) ? $_POST['NoiDung'] : '';
            $ThoiGian = date("H:i:s d/m/Y");
            
            $conn = new mysqli("localhost", "root", "", "qlbantui");

            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO homthu (HoTen, Email, SDT, TieuDe, NoiDung, ThoiGian) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $HoTen, $Email, $SDT, $TieuDe, $NoiDung, $ThoiGian);

            if ($stmt->execute()) {
                $Message = "<div class='success' style='text-align: center; color: red;'>Cảm ơn bạn đã gửi ý kiến của mình. Chúng tôi sẽ sớm phản hồi lại ý kiến của bạn!</div>";

            } else {
                echo "Lỗi: " . $stmt->error;
            }

            $stmt->close();
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

        <!-- Contact -->
        <div class="wrap">
            <div class="contact">
                <h1>Gửi phản hồi</h1>
                <hr>
                <form action="" method="post">
                    <div class="name">
                        <p>Họ tên:</p>
                        <input type="text" name="HoTen" required>
                    </div>
                    <div class="phone">
                        <p>Số điện thoại:</p>
                        <input type="text" name="SDT" required>
                    </div>
                    <div class="email">
                        <p>Email:</p>
                        <input type="text" name="Email" pattern=".*@.*" required title="Email phải chứa ký tự '@'">
                    </div>
                    <div class="head">
                        <p>Tiêu đề:</p>
                        <input type="text" name="TieuDe" required style="width: 100%;">
                    </div>
                    <div class="content">
                        <p>Nội dung:</p>
                        <textarea name="NoiDung" required></textarea>
                    </div>
                    <div class="btn"><button type="submit" name="send">Gửi</button></div>
                    <?php
                        echo $Message;
                    ?>
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