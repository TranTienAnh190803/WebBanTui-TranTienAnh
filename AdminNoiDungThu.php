<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nội dung thư</title>
    <link rel="stylesheet" href="./Style/AdminNoiDungThu.css">
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
</head>
<body>
    <?php
        session_start();

        if (!isset($_SESSION["AdminUsername"]))
        {
            header("Location: AdminDangNhap.php");
            exit();
        }

        $STT = isset($_POST['STT']) ? $_POST['STT'] : '';

        $conn = new mysqli("localhost", "root", "" ,"qlbantui");
        
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        if (isset($_POST["Delete"]))
        {
            $SoThuTu = isset($_POST["SoThuTu"]) ? $_POST["SoThuTu"] : "";
            $sql2 = "DELETE FROM homthu WHERE STT = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("s", $SoThuTu);
            if (!$stmt2->execute()) {
                echo "Lỗi: " . $stmt2->error;
            }
            else
            {
                header("Location: AdminHomThu.php");
            }
            $stmt2->close();
            $conn->close();
        }

        $sql = "SELECT * FROM homthu WHERE STT = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $STT);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $HoTen = $row["HoTen"];
                $Email = $row["Email"];
                $SDT = $row["SDT"];
                $TieuDe = $row["TieuDe"];
                $NoiDung = $row["NoiDung"];
                $ThoiGian = $row["ThoiGian"];
            }
        }

        if (isset($_POST["logout"]))
        {
            session_unset();
            session_destroy();
            header("Location: AdminDangNhap.php");
            exit();
        }
    ?>
    <div class="main">
        <!-- Header -->
        <div class="header">
            <div class="logo"><a href="AdminQLTX.php">Admin</a></div>

            <ul class="nav">
                <li><a href="AdminQLTX.php" class="menu">Quản lý sản phẩm</a></li>
                <li><a href="AdminHomThu.php" class="menu">Hòm thư</a></li>
                <li><form action="" method="post"><button type="submit" class="menu" name="logout">Đăng xuất</button></form></li>
            </ul>
        </div>

        <!-- Mail Content -->
        <div class="wrap">
            <div class="mail-content">
                <p style="display: flex; width: 100%; justify-content: space-between;"><span><b>Người gửi:</b> <?php echo $HoTen; ?></span> <span style="opacity: 0.3;"><?php echo $ThoiGian; ?></span></p>
                <p><b>Email:</b> <?php echo $Email; ?></p>
                <p><b>Số điện Thoại:</b> <?php echo $SDT; ?></p>
                <p style="margin-bottom: 10px;"><b>Tiêu đề: </b> <?php echo $TieuDe; ?></p>
                <p><?php echo $NoiDung; ?></p>
            </div>
            <div class="Delete-mail">
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $STT; ?>" name="SoThuTu">
                    <button type="submit" name="Delete">XÓA THƯ</button>
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