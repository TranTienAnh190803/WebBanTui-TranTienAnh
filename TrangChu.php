<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./Style/TrangChu.css">
</head>
<body>
    <?php
        // session_start();

        // if (!isset($_SESSION["username"])) {
        //     header("Location: DangNhap.php");
        //     exit();
        // }

        $conn = new mysqli("localhost", "root", "" ,"qlbantui");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
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



        <!-- SLIDER -->
        <div class="slider">
            <div class="slider-full active">
                <img src="Image/Slide1.jpg" alt="" class="pic">
                <div class="slider-content slide1">
                    <h1 class="slider-heding">Chào mừng bạn đến với TúiUNETI</h1>
                    <p class="slider-decribe">Trang web bán túi xách của chúng tôi là điểm đến lý tưởng cho những tín đồ thời trang. Với đa dạng mẫu mã, từ túi xách hàng ngày đến những thiết kế cao cấp, chúng tôi cam kết mang đến cho bạn những sản phẩm chất lượng nhất. Đặc biệt, các chương trình khuyến mãi hấp dẫn và dịch vụ giao hàng nhanh chóng sẽ giúp bạn dễ dàng sở hữu những chiếc túi xách ưng ý mà không cần phải ra ngoài. Hãy ghé thăm và tìm cho mình một người bạn đồng hành phong cách!</p>
                </div>
            </div>
            <div class="slider-full">
                <img src="Image/Slide2.jpg" alt="" class="pic">
                <div class="slider-content slide2">
                    <h1 class="slider-heding">Chào mừng bạn đến với TúiUNETI</h1>
                    <p class="slider-decribe">Trang web bán túi xách của chúng tôi là điểm đến lý tưởng cho những tín đồ thời trang. Với đa dạng mẫu mã, từ túi xách hàng ngày đến những thiết kế cao cấp, chúng tôi cam kết mang đến cho bạn những sản phẩm chất lượng nhất. Đặc biệt, các chương trình khuyến mãi hấp dẫn và dịch vụ giao hàng nhanh chóng sẽ giúp bạn dễ dàng sở hữu những chiếc túi xách ưng ý mà không cần phải ra ngoài. Hãy ghé thăm và tìm cho mình một người bạn đồng hành phong cách!</p>
                </div>
            </div>
            <div class="slider-full">
                <img src="Image/Slide3.jpg" alt="" class="pic">
                <div class="slider-content slide3">
                    <h1 class="slider-heding">Chào mừng bạn đến với TúiUNETI</h1>
                    <p class="slider-decribe">Trang web bán túi xách của chúng tôi là điểm đến lý tưởng cho những tín đồ thời trang. Với đa dạng mẫu mã, từ túi xách hàng ngày đến những thiết kế cao cấp, chúng tôi cam kết mang đến cho bạn những sản phẩm chất lượng nhất. Đặc biệt, các chương trình khuyến mãi hấp dẫn và dịch vụ giao hàng nhanh chóng sẽ giúp bạn dễ dàng sở hữu những chiếc túi xách ưng ý mà không cần phải ra ngoài. Hãy ghé thăm và tìm cho mình một người bạn đồng hành phong cách!</p>
                </div>
            </div>
        </div>

        <!-- Product -->
        <div class="product">
            <div class="new-product">
                <h1>SẢN PHẨM MỚI NHẤT</h1>
                <div class="pro">
                    <?php
                        $sql1 = "SELECT * FROM sanpham WHERE DanhMuc = 'Hàng mới'";
                        $result1 = $conn->query($sql1);
                        if ($result1->num_rows > 0) {
                            // Hiển thị các sản phẩm
                            while ($row = $result1->fetch_assoc()) {
                                if ($row['Giam'] == 0)
                                {
                                    $row['Giam'] = 1;
                                }
                                else
                                {
                                    $row['Giam'] = (float)($row['Giam'] / 100);
                                }

                                $gia = $row['Gia'] - ($row['Gia'] * $row['Giam']);
                                $formatted_number1 = number_format($gia, 0, ',', '.');
                                $formatted_number2 = number_format($row['Gia'], 0, ',', '.');

                                echo "<form action='ThongTinChiTiet.php' method='post'>";
                                echo "<input type='hidden' name='product_id' value='".$row['MaSP']."'>";

                                echo "<button type='submit'>";
                                echo "<div class='product-pic'>";
                                echo "<img src='".$row['HinhAnh']."' alt='".$row['TenSP']."'>";
                                echo "<div class='product-detail'>Thông tin chi tiết</div>";
                                echo "</div>";
                                echo "<div class='product-info'>";
                                echo "<p class='product-type'>".$row['LoaiSP']."</p>";
                                echo "<p class='product-name'>".$row['TenSP']."</p>";
                                if ($row['DanhMuc'] == "Hàng giảm giá")
                                {
                                    echo "<p class='product-price'>".$formatted_number1."₫<del style='margin-left: 5px; font-size: 12px; color: black; opacity: 0.5;'>".$formatted_number2."₫</del></p>";
                                }
                                else
                                {
                                    echo "<p class='product-price'>".$formatted_number2."₫</p>";
                                }
                                echo "</div>";
                                echo "</button>";

                                echo "</form>";
                            }
                        } else {
                            echo "<h3 style='text-align: center;'>Không có sản phẩm nào!</h3>";
                        }
                    ?>
                </div>
                <hr style="margin: 50px 0px;">
            </div>

            <div class="discount-product">
                <h1>SẢN PHẨM ĐANG GIẢM GIÁ</h1>
                <div class="pro">
                    <?php
                        $sql2 = "SELECT * FROM sanpham WHERE DanhMuc = 'Hàng giảm giá'";
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            // Hiển thị các sản phẩm
                            while ($row = $result2->fetch_assoc()) {
                                if ($row['Giam'] == 0)
                                {
                                    $row['Giam'] = 1;
                                }
                                else
                                {
                                    $row['Giam'] = (float)($row['Giam'] / 100);
                                }

                                $gia = $row['Gia'] - ($row['Gia'] * $row['Giam']);
                                $formatted_number1 = number_format($gia, 0, ',', '.');
                                $formatted_number2 = number_format($row['Gia'], 0, ',', '.');

                                echo "<form action='ThongTinChiTiet.php' method='post'>";
                                echo "<input type='hidden' name='product_id' value='".$row['MaSP']."'>";

                                echo "<button type='submit'>";
                                echo "<div class='product-pic'>";
                                echo "<img src='".$row['HinhAnh']."' alt='".$row['TenSP']."'>";
                                echo "<div class='product-detail'>Thông tin chi tiết</div>";
                                echo "</div>";
                                echo "<div class='product-info'>";
                                echo "<p class='product-type'>".$row['LoaiSP']."</p>";
                                echo "<p class='product-name'>".$row['TenSP']."</p>";
                                if ($row['DanhMuc'] == "Hàng giảm giá")
                                {
                                    echo "<p class='product-price'>".$formatted_number1."₫<del style='margin-left: 5px; font-size: 12px; color: black; opacity: 0.5;'>".$formatted_number2."₫</del></p>";
                                }
                                else
                                {
                                    echo "<p class='product-price'>".$formatted_number2."₫</p>";
                                }
                                echo "</div>";
                                echo "</button>";

                                echo "</form>";
                            }
                        } else {
                            echo "<h3 style='text-align: center;'>Không có sản phẩm nào!</h3>";
                        }
                    ?>
                </div>
                <hr style="margin: 50px 0px;">
            </div>

            <div class="hot-product">
                <h1>SẢN PHẨM ĐANG HOT</h1>
                <div class="pro">
                    <?php
                        $sql3 = "SELECT * FROM sanpham WHERE DanhMuc = 'Hàng hot'";
                        $result3 = $conn->query($sql3);
                        if ($result3->num_rows > 0) {
                            // Hiển thị các sản phẩm
                            while ($row = $result3->fetch_assoc()) {
                                if ($row['Giam'] == 0)
                                {
                                    $row['Giam'] = 1;
                                }
                                else
                                {
                                    $row['Giam'] = (float)($row['Giam'] / 100);
                                }

                                $gia = $row['Gia'] - ($row['Gia'] * $row['Giam']);
                                $formatted_number1 = number_format($gia, 0, ',', '.');
                                $formatted_number2 = number_format($row['Gia'], 0, ',', '.');

                                echo "<form action='ThongTinChiTiet.php' method='post'>";
                                echo "<input type='hidden' name='product_id' value='".$row['MaSP']."'>";

                                echo "<button type='submit'>";
                                echo "<div class='product-pic'>";
                                echo "<img src='".$row['HinhAnh']."' alt='".$row['TenSP']."'>";
                                echo "<div class='product-detail'>Thông tin chi tiết</div>";
                                echo "</div>";
                                echo "<div class='product-info'>";
                                echo "<p class='product-type'>".$row['LoaiSP']."</p>";
                                echo "<p class='product-name'>".$row['TenSP']."</p>";
                                if ($row['DanhMuc'] == "Hàng giảm giá")
                                {
                                    echo "<p class='product-price'>".$formatted_number1."₫<del style='margin-left: 5px; font-size: 12px; color: black; opacity: 0.5;'>".$formatted_number2."₫</del></p>";
                                }
                                else
                                {
                                    echo "<p class='product-price'>".$formatted_number2."₫</p>";
                                }
                                echo "</div>";
                                echo "</button>";

                                echo "</form>";
                            }
                        } else {
                            echo "<h3 style='text-align: center;'>Không có sản phẩm nào!</h3>";
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

    <script src="./Javascript/TrangChu.js"></script>
</body>
</html>