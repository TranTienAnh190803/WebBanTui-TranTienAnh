<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" href="./Style/AdminQLTX.css">
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
        
        $conn = new mysqli("localhost", "root", "" ,"qlbantui");

        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM sanpham";
        $result = $conn->query($sql);

        // Nút đăng xuất
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

        <!-- Product List -->
        <div class="wrap">
            <div class="product-list">
                <h1>Danh sách các sản phẩm</h1>
                <hr>
                <div class="list">
                    <form action="AdminThemSP.php" method="post" class="add-product"><button type="submit" name="add">Thêm sản phẩm</button></form>
                    <div class="product-table">
                        <table cellpadding="50" border="2">
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Loại sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá chính thức</th>
                                <th></th>
                                <th></th>
                            </tr>
                        
                            <?php
                                if ($result->num_rows > 0)
                                {
                                    while ($row = $result->fetch_assoc())
                                    {
                                        if ($row['Giam'] == 0)
                                        {
                                            $row['Giam'] = 1;
                                        }
                                        else
                                        {
                                            $row['Giam'] = (float)($row['Giam'] / 100);
                                        }
                                        
                                        $gia = $row['Gia'];
                                        if ($row['DanhMuc'] == "Hàng giảm giá")
                                            $gia = $row['Gia'] - ($row['Gia'] * $row['Giam']);
                                        $GiaChinhThuc = number_format($gia, 0, ',', '.');

                                        echo "<tr>";

                                        echo "<td class='product-img'><img src='".$row['HinhAnh']."' alt='".$row['TenSP']."'></td>";
                                        echo "<td>".$row['MaSP']."</td>";
                                        echo "<td>".$row['TenSP']."</td>";
                                        echo "<td>".$row['LoaiSP']."</td>";
                                        echo "<td>".$row['DanhMuc']."</td>";
                                        echo "<td>".$GiaChinhThuc."đ</td>";
                                        echo "<td class='btn'>";
                                        echo "<form action='AdminSuaSP.php' method='post'>";
                                        echo "<input type='hidden' name='product_id' value='".$row['MaSP']."'>";
                                        echo "<button type='submit' name='update' class='update'>Sửa</button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "<td class='btn'>";
                                        echo "<form action='AdminXoaSP.php' method='post'>";
                                        echo "<input type='hidden' name='product_id' value='".$row['MaSP']."'>";
                                        echo "<button type='submit' name='delete' class='delete'>Xóa</button>";
                                        echo "</form>";
                                        echo "</td>";
                                        
                                        echo "</tr>";
                                    }
                                }
                                else
                                {
                                    echo "<h3 style='text-align: center; color: red;'>Chưa có sản phẩm nào trên hệ thống.</h3>";
                                }
                            ?>

                        </table>
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
</body>
</html>