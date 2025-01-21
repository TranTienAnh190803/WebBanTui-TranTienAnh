<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sản Phẩm</title>
    <link rel="stylesheet" href="./Style/AdminThemSuaXoa.css">
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

        $conn = new mysqli("localhost", "root", "", "qlbantui");
        if ($conn->connect_error)
        {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $ProductId = isset($_POST["product_id"]) ? $_POST["product_id"] : "";

        if (isset($_POST["Delete"]))
        {
            $MaSP = isset($_POST["MaSP"]) ? $_POST["MaSP"] : "";
            $sql2 = "DELETE FROM sanpham WHERE MaSP = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("s", $MaSP);
            if (!$stmt2->execute()) {
                echo "Lỗi: " . $stmt2->error;
            }
            else
            {
                header("Location: AdminQLTX.php");
            }
            $stmt2->close();
            $conn->close();
        }

        $sql1 = "SELECT * FROM sanpham WHERE MaSP = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("s", $ProductId);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows > 0)
        {
            while($row = $result1->fetch_assoc())
            {
                $MaSP = $row["MaSP"];
                $TenSP = $row["TenSP"];
                $LoaiSP = $row["LoaiSP"];
                $MoTa = $row["MoTa"];
                $Gia = (float)$row["Gia"];
                $Giam = (float)$row["Giam"];
                $DanhMuc = $row["DanhMuc"];
                $HinhAnh = $row["HinhAnh"];
            }
        }
        else 
        {
            echo "Không tìm thấy sản phẩm.";
            exit();
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

        <!-- Add Product -->
        <div class="wrap">
            <div class="add-product">
                <h1 style="color: red;">Xóa sản phẩm</h1>
                <hr>
                <form action="" method="post">
                    <div class="MaSP">
                        <p>Mã sản phẩm:</p>
                        <input type="text" name="MaSP" readonly style="background-color: rgba(150, 150, 150, 0.5);" value="<?php echo $MaSP; ?>">
                    </div>
                    <div class="TenSP">
                        <p>Tên sản phẩm:</p>
                        <input type="text" name="TenSP" readonly style="background-color: rgba(150, 150, 150, 0.5);" value="<?php echo $TenSP; ?>">
                    </div>
                    <div class="LoaiSP">
                        <p>Loại sản phẩm:</p>
                        <input type="text" name="LoaiSP" readonly style="background-color: rgba(150, 150, 150, 0.5);" value="<?php echo $LoaiSP; ?>">
                    </div>
                    <div class="Gia">
                        <p>Giá:</p>
                        <input type="text" name="Gia" readonly style="background-color: rgba(150, 150, 150, 0.5);" value="<?php echo $Gia; ?>">
                    </div>
                    <div class="DanhMuc">
                        <p>Danh mục:</p>
                        <input type="text" name="DanhMuc" readonly style="background-color: rgba(150, 150, 150, 0.5);" value="<?php echo $DanhMuc; ?>">
                    </div>
                    <div class="Giam">
                        <p>Giảm:</p>
                        <input type="number" name="Giam" step="0.1" min="0" max="1" readonly style="background-color: rgba(150, 150, 150, 0.5);" value="<?php echo $Giam; ?>">
                    </div>
                    <div class="HinhAnh">
                        <p>Đường dẫn ảnh:</p>
                        <input type="text" name="HinhAnh" readonly style="width: 100%; background-color: rgba(150, 150, 150, 0.5);" value="<?php echo $HinhAnh; ?>">
                    </div>
                    <div class="MoTa">
                        <p>Mô tả:</p>
                        <textarea name="MoTa" readonly style="background-color: rgba(150, 150, 150, 0.5);"><?php echo $MoTa; ?></textarea>
                    </div>
                    <div class="btn">
                        <button type="submit" name="Delete" style="background-color: darkred;">Xóa</button>
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