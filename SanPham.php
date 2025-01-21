<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./Style/SanPham.css">
</head>
<body>
    <?php
        // Kết nối cơ sở dữ liệu MySQL
        // Tạo kết nối
        $conn = new mysqli("localhost", "root", "" ,"qlbantui");

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Xuất sản phẩm
        if (isset($_POST["LoaiSP"]))
        {
            $ProductType = isset($_POST['ProductType']) ? $_POST['ProductType'] : '';
            $sql = "SELECT * FROM sanpham WHERE LoaiSP = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $ProductType);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        else if (isset($_POST["1m"]))
        {
            $sql = "SELECT * FROM sanpham WHERE Gia > 1000000";
            $result = $conn->query($sql);
        }
        else if (isset($_POST["500k-1m"]))
        {
            $sql = "SELECT * FROM sanpham WHERE Gia > 500000 AND Gia < 1000000";
            $result = $conn->query($sql);
        }
        else if (isset($_POST["500k"]))
        {
            $sql = "SELECT * FROM sanpham WHERE Gia < 500000";
            $result = $conn->query($sql);
        }
        else if (isset($_POST["find"]))
        {
            $SearchProduct = isset($_POST['search-product']) ? $_POST['search-product'] : '';
            $Search = $SearchProduct;
            $sql = "SELECT * FROM sanpham WHERE TenSP LIKE ?";
            $SearchProduct = "%" . $SearchProduct . "%";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $SearchProduct);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        else if (isset($_POST["BanChay"]))
        {
            $sql = "SELECT * FROM sanpham WHERE DanhMuc = 'Hàng hot'";
            $result = $conn->query($sql);
        }
        else if (isset($_POST["GiamGia"]))
        {
            $sql = "SELECT * FROM sanpham WHERE DanhMuc = 'Hàng giảm giá'";
            $result = $conn->query($sql);
        }
        else if (isset($_POST["New"]))
        {
            $sql = "SELECT * FROM sanpham WHERE DanhMuc = 'Hàng mới'";
            $result = $conn->query($sql);
        }
        else
        {
            // Truy vấn danh sách sản phẩm từ cơ sở dữ liệu
            $sql = "SELECT * FROM sanpham"; // Cập nhật tên bảng và cột phù hợp với cơ sở dữ liệu của bạn
            $result = $conn->query($sql);
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

        <!-- Products -->
        <div class="product">
            <div class="product-content">
                <h1>SẢN PHẨM CHẤT LƯỢNG CAO</h1>
            </div>
            <hr>
            <div class="main-product">
                <div class="sidebar">
                    <div class="product-type">
                        <h3>Tìm kiếm</h3>

                        <form action="" method="post" class="search-product">
                            <input type="text" name="search-product" placeholder="Tìm kiếm sản phẩm" value="<?php echo isset($Search) ? $Search : ""; ?>">
                            <button type="submit" name="find"><i class="ti-search"></i></button>
                        </form>
                    </div>
                    
                    
                    <div class="product-type">
                        <h3>Loại sản phẩm</h3>

                        <div class="nav-content">
                            <form action="" method="post">
                                <input type="hidden" name="ProductType" value="">
                                <button type="submit">Tất cả</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductType" value="Túi nhỏ">
                                <button type="submit" name="LoaiSP">Túi nhỏ</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductType" value="Túi trung">
                                <button type="submit" name="LoaiSP">Túi trung</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductType" value="Túi lớn">
                                <button type="submit" name="LoaiSP">Túi lớn</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductType" value="Balo">
                                <button type="submit" name="LoaiSP">Balo</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductType" value="Ví-Clutch">
                                <button type="submit" name="LoaiSP">Ví-Clutch</button>
                            </form>
                        </div>
                    </div>

                    <div class="product-type">
                        <h3>Danh mục</h3>

                        <div class="nav-content">
                            <form action="" method="post">
                                <input type="hidden" name="ProductNew" value="Hàng mới">
                                <button type="submit" name="New">Hàng Mới</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductDis" value="Hàng giảm giá">
                                <button type="submit" name="GiamGia">Hàng Giảm Giá</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductHot" value="Hàng hot">
                                <button type="submit" name="BanChay">Hàng Bán Chạy</button>
                            </form>
                        </div>
                    </div>

                    <div class="product-type">
                        <h3>Giá sản phẩm</h3>

                        <div class="nav-content">
                            <form action="" method="post">
                                <input type="hidden" name="ProductPrice" value="Hàng mới">
                                <button type="submit" name="1m">Trên 1.000.000đ</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductPrice" value="Hàng giảm giá">
                                <button type="submit" name="500k-1m">Từ 500.000đ - 1.000.000đ</button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="ProductPrice" value="Hàng hot">
                                <button type="submit" name="500k">Dưới 500.000đ</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="pd">
                    <?php
                        if ($result->num_rows > 0) {
                            // Hiển thị các sản phẩm
                            while ($row = $result->fetch_assoc()) {
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
</body>
</html>