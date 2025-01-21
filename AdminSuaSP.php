<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
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
        
        if (isset($_POST["Update"]))
        {
            $MaSPBD = isset($_POST["MaSPBD"]) ? $_POST["MaSPBD"] : "";
            $MaSP2 = isset($_POST["MaSP"]) ? $_POST["MaSP"] : "";
            $TenSP2 = isset($_POST["TenSP"]) ? $_POST["TenSP"] : "";
            $LoaiSP2 = isset($_POST["LoaiSP"]) ? $_POST["LoaiSP"] : "";
            $Gia2 = (float)isset($_POST["Gia"]) ? $_POST["Gia"] : 0;
            $DanhMuc2 = isset($_POST["DanhMuc"]) ? $_POST["DanhMuc"] : "";
            $Giam2 = (float)isset($_POST["Giam"]) && $_POST["DanhMuc"] == "Hàng giảm giá" ? $_POST["Giam"] : 0;
            $HinhAnh2 = isset($_POST["HinhAnh"]) ? $_POST["HinhAnh"] : "";
            $MoTa2 = isset($_POST["MoTa"]) ? $_POST["MoTa"] : "";

            $sql2 = "UPDATE sanpham SET MaSP = ?, TenSP = ?, LoaiSP = ?, MoTa = ?, Gia = ?, Giam = ?, DanhMuc = ?, HinhAnh = ? WHERE MaSP = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("sssssssss", $MaSP2, $TenSP2, $LoaiSP2, $MoTa2, $Gia2, $Giam2, $DanhMuc2, $HinhAnh2, $MaSPBD);
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
                <h1 style="color: darkgoldenrod;">Sửa sản phẩm</h1>
                <hr>
                <form action="" method="post">
                    <div class="MaSP">
                        <p>Mã sản phẩm:</p>
                        <input type="text" name="MaSP" value="<?php echo $MaSP; ?>" required>
                    </div>
                    <div class="TenSP">
                        <p>Tên sản phẩm:</p>
                        <input type="text" name="TenSP" value="<?php echo $TenSP; ?>" required>
                    </div>
                    <div class="LoaiSP">
                        <p>Loại sản phẩm:</p>
                        <input type="text" name="LoaiSP" value="<?php echo $LoaiSP; ?>" required>
                    </div>
                    <div class="Gia">
                        <p>Giá:</p>
                        <input type="text" name="Gia" value="<?php echo $Gia ?>" required>
                    </div>
                    <div class="DanhMuc">
                        <p>Danh mục:</p>
                        <select name="DanhMuc" class="combobox" required>
                            <option value="Hàng thường" <?php if ($DanhMuc == "Hàng thường") echo "selected"; ?>>Hàng thường</option>
                            <option value="Hàng hot" <?php if ($DanhMuc == "Hàng hot") echo "selected"; ?>>Hàng hot</option>
                            <option value="Hàng mới" <?php if ($DanhMuc == "Hàng mới") echo "selected"; ?>>Hàng mới</option>
                            <option value="Hàng giảm giá" <?php if ($DanhMuc == "Hàng giảm giá") echo "selected"; ?>>Hàng giảm giá</option>
                        </select>
                    </div>
                    <div class="Giam">
                        <p>Giảm:</p>
                        <input type="number" name="Giam" min="0" max="100" class="discount" value="<?php echo $Giam; ?>" readonly>
                    </div>
                    <div class="HinhAnh">
                        <p>Đường dẫn ảnh:</p>
                        <input type="text" name="HinhAnh" id="FilePath" value="<?php echo $HinhAnh; ?>" required style="width: 85%;">
                        <label for="DangAnh" id="FileOpen">Chọn ảnh</label>
                        <input type="file" id="DangAnh" name="image" accept="image/*" style="width: 10%;">
                    </div>
                    <div class="MoTa">
                        <p>Mô tả:</p>
                        <textarea name="MoTa" required><?php echo $MoTa; ?></textarea>
                    </div>
                    <div class="btn">
                        <input type="hidden" name="MaSPBD" value="<?php echo $MaSP; ?>"> 
                        <button type="submit" name="Update" style="background-color: darkgoldenrod;">Sửa</button>
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

    <script src="./Javascript/AdminSua.js"></script>
</body>
</html>