<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./Style/GioHang.css">
</head>
<body>
    <?php
        session_start();

        if (!isset($_SESSION["username"])) {
            header("Location: DangNhap.php");
            exit();
        }
        else
        {
            $TongTien = 0;
            $Message = "";
            $Username = $_SESSION["username"];
            $conn = new mysqli("localhost", "root", "", "qlbantui");

            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $sql = "SELECT TenDN, giohang.MaSP, TenSP, SoLuong, giohang.Gia, ThanhTien, sanpham.HinhAnh FROM giohang, sanpham WHERE giohang.MaSP = sanpham.MaSP AND TenDN = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $Username);
            $stmt->execute();
            $result = $stmt->get_result();

            if (isset($_POST["delete"]))
            {
                $Ma = isset($_POST['product_id']) ? $_POST['product_id'] : "";
                $sql1 = "DELETE FROM giohang WHERE TenDN = ? AND MaSP = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("ss", $Username, $Ma);
                if($stmt1->execute())
                {
                    header("Location: GioHang.php");
                    exit();
                }
                else
                {
                    echo "Lỗi: " . $stmt->error;
                }
            }
            if (isset($_POST["checkout"]))
            {
                $sql2 = "DELETE FROM giohang WHERE TenDN = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("s", $Username);
                if($stmt2->execute())
                {
                    $Message = "<h3 style='text-align: center; color: green;'>Cảm ơn quý khách đã mua hàng. Chúng tôi sẽ giao hàng đến đúng địa chỉ mà quý khách đã cung cấp trong tài khoản cá nhân</h3>";
                }
                else
                {
                    echo "Lỗi: " . $stmt->error;
                }
            }
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

        <!-- Cart -->
        <div class="wrap">
            <div class="cart">
                <h1>Giỏ hàng của bạn</h1>
                <hr>
                <div class="product-sent">
                    <?php
                        if ($result->num_rows > 0)
                        {
                            while ($row = $result->fetch_assoc())
                            {
                                $TongTien = (float)($TongTien + $row['ThanhTien']);
                                $ThanhTien = number_format($row['ThanhTien'], 0, ',', '.');
                                echo "<div class='container'>";

                                echo "<div class='product-image'>";
                                echo "<img src='".$row['HinhAnh']."' alt='".$row['TenSP']."'>";
                                echo "</div>";

                                echo "<div class='product-info'>";
                                echo "<h3 style='font-weight: bold; margin-bottom: 10px; text-transform: uppercase;'>".$row['TenSP']."</h3>";
                                echo "<p>Số lượng: ".$row['SoLuong']."</P>";
                                echo "<p>Thành tiền: ".$ThanhTien."đ</p>";
                                echo "</div>";

                                echo "<form action='GioHang.php' method='post'>";
                                echo "<input type='hidden' name='product_id' value='".$row['MaSP']."'>";
                                echo "<button type='submit' name='delete'>Xóa</button>";
                                echo "</form>";

                                echo "</div>";
                                echo "<hr>";
                            }

                            $Sum = number_format($TongTien, 0, ',', '.');
                            echo "<div class='payment'>";

                            echo "<div class='sum'>";
                            echo "<b>Tổng tiền: <span style='color: red;'>".$Sum."đ</span></b>";
                            echo "</div>";

                            echo "<form action='GioHang.php' method='post'>";
                            echo "<button type='submit' name='checkout'>Thanh Toán</button>";
                            echo "</form>";

                            echo "</div>";
                        }
                        else
                        {
                            if (empty($Message))
                                echo "<h3 style='text-align: center; color: red;'>Quý khách chưa có sản phẩm nào trong giỏ hàng.</h3>";
                            else
                                echo $Message;
                        }
                    ?>
                </div>
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