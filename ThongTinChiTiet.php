<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết</title>
    <link rel="stylesheet" href="./Icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./Style/ThongTinChiTiet.css">
</head>
<body>
    <?php
        //Phải đăng nhập mới xem được thông tin
        session_start();

        if (!isset($_SESSION["username"])) {
            header("Location: DangNhap.php");
            exit();
        }
        else
        {
            $conn = new mysqli("localhost", "root", "", "qlbantui");
            $Message = "";

            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $ProductId = isset($_POST['product_id']) ? $_POST['product_id'] : '';

            $sql = "SELECT * FROM sanpham WHERE MaSP = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $ProductId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $MaSP = $row["MaSP"];
                    $TenSP = $row["TenSP"];
                    $LoaiSP = $row["LoaiSP"];
                    $MoTa = $row["MoTa"];
                    $Gia = (float)$row["Gia"];
                    $Giam = (float)$row["Giam"];
                    $DanhMuc = $row["DanhMuc"];
                    $ThuongHieu = $row["ThuongHieu"];
                    $HinhAnh = $row["HinhAnh"];

                    if ($Giam == 0)
                    {
                        $Giam = 1;
                    }
                    else
                    {
                        $Giam = (float)($Giam / 100);
                    }
                }
            } else {
                echo "Không tìm thấy sản phẩm.";
                exit();
            }

            if (isset($_POST["send-to-cart"]))
            {
                $SoLuong = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
                $GiaHang = isset($_POST['product_price']) ? $_POST['product_price'] : 0;
                $TenDN = $_SESSION["username"];
                $ThanhTien = (float)($SoLuong * $GiaHang);

                $sql1 = "SELECT * FROM giohang WHERE TenDN = ? AND MaSP = ?";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bind_param("ss", $TenDN, $ProductId);
                $stmt1->execute();
                $result1 = $stmt1->get_result();

                if ($result1->num_rows > 0)
                {
                    //$Message = "<div class='success' style='text-align: center; color: red; font-weight: bold; margin-top: 20px;'>Quý khách đã thêm hàng này vào giỏ hàng rồi. <a href='SanPham.php' style='color: blue;'>Quay lại trang Sản Phẩm</a></div>";
                    $sql3 = "UPDATE giohang SET SoLuong = ?, Gia = ?, ThanhTien = ? WHERE TenDN = ? AND MaSP = ?";
                    $stmt3 = $conn->prepare($sql3);
                    $stmt3->bind_param("sssss", $SoLuong, $GiaHang, $ThanhTien, $TenDN, $ProductId);
                    if ($stmt3->execute())
                    {
                        $Message = "<div class='success' style='text-align: center; color: green; font-weight: bold; margin-top: 20px;'>Hàng của quý khách đã được cập nhật lại vào giỏ hàng. <a href='SanPham.php' style='color: blue;'>Quay lại trang Sản Phẩm</a></div>";
                    }
                    else
                    {
                        echo "Lỗi: " . $stmt3->error;
                    }
                }
                else
                {
                    $sql2 = "INSERT INTO giohang VALUES(?, ?, ?, ?, ?)";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bind_param("sssss", $TenDN, $ProductId, $SoLuong, $GiaHang, $ThanhTien);
                    if ($stmt2->execute())
                    {
                        $Message = "<div class='success' style='text-align: center; color: green; font-weight: bold; margin-top: 20px;'>Hàng của quý khách đã được thêm vào giỏ hàng. <a href='SanPham.php' style='color: blue;'>Quay lại trang Sản Phẩm</a></div>";
                    }
                    else
                    {
                        echo "Lỗi: " . $stmt2->error;
                    }
                }
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

        <!-- Thông tin chi tiết -->
        <div class="content">
            <div class="product-content">
                <h1>THÔNG TIN CHI TIẾT SẢN PHẨM</h1>
            </div>

            <hr>

            <div class="detail">
                <div class="product-pic">
                    <img src="<?php echo $HinhAnh; ?>" alt="">
                </div>
                <div class="product-info">
                    <?php 
                        if ($DanhMuc != "Hàng thường")
                            echo "<p class='product-catalog'>". $DanhMuc . "</p>";
                    ?>
                    <h2><?php echo $TenSP; ?></h2>
                    <div class="price">
                        <label for="product-price">Giá: </label>
                        <?php
                            $formatted_number2 = number_format($Gia, 0, ',', '.');
                            if ($DanhMuc == "Hàng giảm giá")
                            {
                                $GiaGiam = (float)($Gia - ($Gia * $Giam));
                                $formatted_number1 = number_format($GiaGiam, 0, ',', '.');
                                echo "<span class='product-price'>".$formatted_number1."₫<del style='margin-left: 5px; font-size: 12px; color: black; opacity: 0.5;'>".$formatted_number2."₫</del></span>";
                            }
                            else
                            {
                                echo "<span class='product-price'>".$formatted_number2."₫</span>";
                            }
                        ?>
                    </div>
                    
                    <form action="ThongTinChiTiet.php" method="post">
                        <div class="number">
                            <label>Số lượng: </label>
                            <button class="minus plusminus" type="button">-</button>
                            <input type="number" min="1" value="1" name="quantity">
                            <button class="plus plusminus" type="button">+</button>
                        </div>
                        <input type="hidden" name="product_id" value="<?php echo $MaSP; ?>">
                        <input type="hidden" name="product_price" value="<?php 
                            if ($DanhMuc == "Hàng giảm giá")
                                echo $GiaGiam;
                            else
                                echo $Gia;
                        ?>">
                        <button type="submit" class="send-to-cart" name="send-to-cart">Đặt vào giỏ hàng</button>
                        <?php
                            echo $Message;
                        ?>
                    </form>
                    <div class="feture">
                        <ul>
                            <li><b>Mã sản phẩm: </b> <?php echo $MaSP; ?></li>
                            <li><b>Thương hiệu: </b> <?php echo $ThuongHieu; ?></li>
                            <li><b>Loại sản phẩm: </b> <?php echo $LoaiSP;?></li>
                            <li><b>Mô tả: </b> <?php echo $MoTa; ?></li>
                            <li><b>Ưu đãi: </b>
                                <ul style="margin-left: 30px;">
                                    <li>Miễn phí ship toàn quốc</li>
                                    <li>Mua hàng online - Miễn phí trả hàng hoàn tiền tại cửa hàng trong 7 ngày</li>
                                </ul>
                            </li>
                            <li><b>Giá đã bao gồm VAT</b></li>
                        </ul>
                    </div>
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

    <script src="./Javascript/ThongTinChiTiet.js"></script>
</body>
</html>