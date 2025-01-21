-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 03:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlbantui`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `TenAdmin` varchar(30) NOT NULL,
  `MKAdmin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`TenAdmin`, `MKAdmin`) VALUES
('Admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `TenDN` varchar(50) NOT NULL,
  `MaSP` varchar(20) NOT NULL,
  `SoLuong` int(5) NOT NULL,
  `Gia` float NOT NULL,
  `ThanhTien` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`TenDN`, `MaSP`, `SoLuong`, `Gia`, `ThanhTien`) VALUES
('NamKhanh', 'Tui02', 1, 749000, 749000),
('Trung', 'Tui01', 2, 719000, 1438000),
('Trung', 'Tui02', 3, 749000, 2247000);

-- --------------------------------------------------------

--
-- Table structure for table `homthu`
--

CREATE TABLE `homthu` (
  `STT` int(11) NOT NULL,
  `HoTen` varchar(30) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `SDT` varchar(15) NOT NULL,
  `TieuDe` varchar(100) NOT NULL,
  `NoiDung` varchar(1000) NOT NULL,
  `ThoiGian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homthu`
--

INSERT INTO `homthu` (`STT`, `HoTen`, `Email`, `SDT`, `TieuDe`, `NoiDung`, `ThoiGian`) VALUES
(17, 'Trần Tiến Anh', 'tienanh@gmail.com', '0123456789', 'Lời cảm ơn', 'Xin chào, tôi là Trần Tiến Anh. Tôi có 2 năm làm việc trong lĩnh vực lập trình web. Với sự đam mê và cam kết trong công việc, tôi luôn nỗ lực không ngừng để phát triển bản thân và hoàn thiện kỹ năng nhằm mang lại những giá trị tối ưu cho công ty.\r\nTrong công việc, tôi đặc biệt chú trọng đến tư duy sáng tạo, khả năng làm việc nhóm. Tôi tin rằng những kinh nghiệm và kỹ năng tôi có sẽ là nền tảng vững chắc để đóng góp tích cực cho đội nhóm và giúp công ty đạt được mục tiêu.', '21:19:44 08/11/2024'),
(18, 'Doãn Nam Khánh', 'namkhanh@gmail.com', '0123456789', 'Lời chào', '123456789', '21:22:18 08/11/2024'),
(20, 'Nguyễn Thành Trung', 'thanhtrung@gmail.com', '0123456789', 'Sự hài lòng', '1234567890', '22:28:34 15/11/2024');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(20) NOT NULL,
  `TenSP` varchar(50) NOT NULL,
  `LoaiSP` varchar(30) NOT NULL,
  `MoTa` varchar(1000) NOT NULL,
  `Gia` float NOT NULL,
  `Giam` float NOT NULL,
  `DanhMuc` varchar(50) NOT NULL,
  `HinhAnh` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `LoaiSP`, `MoTa`, `Gia`, `Giam`, `DanhMuc`, `HinhAnh`) VALUES
('Tui01', 'Túi Xách Nhỏ Đeo Vai Khoá Tròn Phối 2 Màu', 'Túi nhỏ', 'Túi Xách Nhỏ Đeo Vai Khoá Tròn Phối 2 Màu trẻ trung, thời trang Túi nắp gập phối khóa kim loại tròn cách điệu nổi bật, tạo điểm nhấn Dây đeo có thể tuỳ chỉnh độ dài.', 719000, 0, 'Hàng thường', './Image/Products/TuiNho/TuiDeoVaiKhoaTron.jpg'),
('Tui02', 'Túi Xách Nhỏ Phối Tay Cầm Xoắn', 'Túi nhỏ', 'Túi Xách Nhỏ Phối Tay Cầm Xoắn thời trang. Form cứng cáp, quai cầm tay xoắn tạo điểm nhấn và cực kì mới lạ. Dây đeo có thể đeo nhiều kiểu, phù hợp với nhiều phong cách.', 749000, 0, 'Hàng hot', './Image/Products/TuiNho/TuiNhoPhoiTayCamXoan.jpg'),
('Tui03', 'Túi Xách Nhỏ Radio Phối Khoá', 'Túi nhỏ', 'Túi Xách Nhỏ Radio Phối Khoá thời trang. Khoá kim loại trang trí cách điệu hình radio mới lạ, nổi bật. Dây đeo là sự kết hợp giữa dây da truyền thống và xích kim loại được thiết kế cách điệu độc đáo.', 799000, 30, 'Hàng giảm giá', './Image/Products/TuiNho/TuiRadioPhoiKhoa.jpg'),
('Tui04', 'Túi Xách Nhỏ Đeo Vai Bear Hug', 'Túi nhỏ', 'Túi được phối màu và họa tiết chữ mới lại. Quai đeo tạo hình nơ mang lại nét nổi bật khi diện. Chất liệu da tổng hợp cao cấp, phù hợp mang nhiều dịp: đi làm, dạo phố, dự tiệc', 799000, 0, 'Hàng mới', './Image/Products/TuiNho/TuiXachNhoBearHug.jpg'),
('Tui05', 'Túi Xách Nhỏ Tay Cầm Trang Trí Khoá', 'Túi nhỏ', 'Form cứng cáp, bo tròn góc phối tay cầm có thể điều chỉnh tiện dụng. Túi có phần tay cầm và dây đeo có thể đeo nhiều kiểu, phù hợp với nhiều phong cách', 799000, 0, 'Hàng mới', './Image/Products/TuiNho/TuiXachNhoTayCamTrangTriKhoa.jpg'),
('Tui06', 'Túi Xách Nhỏ Top Handle Trang Trí Nơ', 'Túi nhỏ', 'Form cứng cáp, phối viền mơ đầy nổi bật và nữ tính. Túi có phần tay cầm và dây đeo có thể đeo nhiều kiểu, phù hợp với nhiều phong cách.', 849000, 10, 'Hàng giảm giá', './Image/Products/TuiNho/TuiXachNhoTopHandle.jpg'),
('Tui07', 'Túi Xách Trung Dạng Tote Form Mềm', 'Túi trung', 'Túi có phần quai dễ dàng điều chỉnh kích thước, phới nơ nổi bật và mới lạ. Túi có 1 ngăn lớn, khóa kim loại tiện dụng. Chất liệu da tổng hợp dễ bảo quản', 800000, 0, 'Hàng thường', './Image/Products/TuiTrung/TuiDangToteFormMem.jpg'),
('Tui08', 'Túi Đeo Vai Tennis Club', 'Túi trung', 'Bên ngoài có thẻ tag treo trang trí sang trọng. Bên trong có 01 ngăn lớn kèm khóa kéo tiện dụng. Chất liệu da tổng hợp cao cấp, có thể ứng dụng nhiều dịp như đi làm, đi tiệc, đi chơi.', 755000, 25, 'Hàng giảm giá', './Image/Products/TuiTrung/TuiDeoVaiTennisClub.jpg'),
('Tui09', 'Túi Xách Lớn Hoạ Tiết Nautical', 'Túi lớn', 'Túi xách lớn hoạ tiết Nautical cực kì mới lạ, tạo điểm nhấn. Túi thiết kế size to, bề mặt phối 2 màu in dập nổi đan xen họa tiết của biển mang lại sự nổi bật khi đeo.', 1049000, 30, 'Hàng giảm giá', './Image/Products/TuiLon/TuiHoaTietNautical.jpg'),
('Tui10', 'Túi Xách Lớn Satchel 2 Ngăn', 'Túi lớn', 'Túi xách lớn với quai cầm tay chắc chắn, thanh lịch.Khoang túi bên trong rộng rãi, có 2 ngăn lớn cực kì tiện dụng. Chất liệu da tổng hợp cao cấp bền đẹp', 855000, 0, 'Hàng thường', './Image/Products/TuiLon/TuiSatchel2Ngan.jpg'),
('Tui11', 'Túi Tote Camping', 'Túi trung', 'Độc đáo, phá cách, form mới lạ. Phần khóa trang trí cách điệu giữa túi tạo điểm nhấn, không gian túi rộng rãi. Có da PU đi kèm dễ dàng thay đổi phong cách.', 899000, 0, 'Hàng hot', './Image/Products/TuiTrung/TuiToteCamping.jpg'),
('Tui12', 'Balo Bear Hug', 'Balo', 'Balo Bear Hug trẻ trung. Điểm nhấn in chữ và gắn gấu nổi bật, năng động. Dây balo có thể tuỳ chỉnh độ dài, dây đeo bản to hạn chế đau vai khi sử dụng. Túi thiết kế 2 ngăn lớn rộng, có kèm đệm chống sốc cho bạn đựng laptop. Chất liệu da tổng hợp dễ dàng vệ sinh, bền, đẹp.', 949000, 50, 'Hàng giảm giá', './Image/Products/Balo/BaloBearHug.jpg'),
('Tui13', 'Balo Laptop Canvas', 'Balo', 'Balo Laptop Canvas thiết kế thời trang, tiện dụng. Thiết kế form to, cứng cáp. Phần ngăn phụ ngoài phối nắp gập tạo điểm nhấn. Bên trong có một ngăn lớn rộng, đựng được nhiều vận dụng cần thiết và phối khóa kéo tiện dụng.', 899000, 0, 'Hàng mới', './Image/Products/Balo/BaloLaptopCanvas.jpg'),
('Tui14', 'Balo Mini Cozy', 'Balo', 'Balo mini Cozy với hoạ tiết dập nổi bắt mắt cùng kiểu dáng nhỏ nhắn. Phía trước có một ngăn nhỏ tiện lợi và khoang túi một ngăn rộng có thể đựng nhiều đồ dùng cá nhân.', 799000, 0, 'Hàng mới', './Image/Products/Balo/BaloMiniCosy.jpg'),
('Tui15', 'Ví Dài Camping', 'Ví-Clutch', 'Ví dài camping trang trí khóa phối kim loại 2 màu silver, gold, khắc chữ kí logo Juno đẹp mắt. Túi nhiều ngăn nhỏ cho bạn để các vật dụng cần thiết. Ví tặng kèm dây đeo kim loại tiện lợi. Chất liệu da tổng hợp, dễ dàng vệ sinh, bền đẹp.\r\n', 499000, 0, 'Hàng hot', './Image/Products/Vi-Clutch/ViDaiCamping.jpg'),
('Tui16', 'Balo Nhỏ Đính Hoa 3D', 'Balo', 'Balo mini Cozy với hoạ tiết dập nổi bắt mắt cùng kiểu dáng nhỏ nhắn. Phía trước có một ngăn nhỏ tiện lợi và khoang túi một ngăn rộng có thể đựng nhiều đồ dùng cá nhân.', 799000, 0, 'Hàng hot', './Image/Products/Balo/BaloMiniHoa3D.jpg'),
('Tui17', 'Túi Xách Lớn Tote Lớn Trang Trí Charm Juno', 'Túi lớn', 'Túi xách lớn tote trang trí charm Juno thanh lịch, phù hợp với chị em văn phòng. Khoang túi bên trong rộng rãi, có nhiều ngăn nhỏ giúp việc sắp xếp ngăn nắp, tiện dụng. Chất liệu da tổng hợp cao cấp bền đẹp', 859000, 90, 'Hàng giảm giá', './Image/Products/TuiLon/TuiToteCharmJuno.jpg'),
('Tui18', 'Ví Enhanced Sensuality', 'Ví-Clutch', 'Ví Enhanced Sensuality nhỏ gọn, tiện dụng mang mọi nơi. Khoá và dây đeo kim loại tạo điểm nhấn mang đến sự sang trọng.', 249000, 0, 'Hàng mới', './Image/Products/Vi-Clutch/ViEnhancedSensuality.jpg'),
('Tui19', 'Ví có dây họa tiết Diamond Lattice', 'Ví-Clutch', 'Ví có dây họa tiết Diamond Lattice thanh lịch. Bên trong thiết kế nhiều ngăn nhỏ, tiện dụng. Chất liệu da tổng hợp cao cấp, Vì phù hợp dung như ví tiền hoặc đi tiệc, dạo phố.	\r\n', 600000, 0, 'Hàng mới', './Image/Products/Vi-Clutch/ViHoaTietDiamondLattice.jpg'),
('Tui20', 'Túi xách Trung Tote In logo JN', 'Túi trung', 'Túi xách trung tote in logo Jn thanh lịch, hiện đại, phù hợp đi học, đi làm,.. Túi có 01 ngăn lớn rộng rãi và những ngăn nhỏ cho bạn thoải mái mang theo vận dụng cần thiết.\r\n', 899000, 0, 'Hàng thường', './Image/Products/TuiTrung/TuiToteLogoJn.jpg'),
('Tui21', 'Túi Satchel - Enhanced Confidence', 'Túi trung', 'Độc đáo, phá cách, form mới lạ. Phần khóa trang trí cách điệu giữa túi tạo điểm nhấn, không gian túi rộng rãi. Có da PU đi kèm dễ dàng thay đổi phong cách.\r\n', 899000, 25, 'Hàng giảm giá', './Image/Products/TuiTrung/TuiSatchel-EnhancedConfidence.jpg'),
('Tui22', 'Túi Dập Hiệu Ứng Princess Diamond', 'Túi trung', 'Túi xách dáng hộp dập nổi hình kim cương thanh lịch, sang trọng. Bề mặt phối hai màu trẻ trung. Bên trong có 1 ngăn lớn kèm khóa kéo tiện dụng và ngăn nhỏ. Tặng kèm quai đeo dài. Chất liệu da tổng hợp cao cấp, phù hợp với dịp đi làm, dạo phố hay đi tiệc\r\n', 799000, 0, 'Hàng hot', './Image/Products/TuiTrung/TuiPrincessDiamond.jpg'),
('Tui23', 'Balo tay cầm nhún', 'Balo', 'Balo dáng đưng mini, tay cầm nhún mới lạ bắt mắt. Kiểu dáng nhỏ nhắn, khoang túi một ngăn rộng có thể đựng nhiều đồ dùng cá nhân. Chất liệu da tổng hợp cao cấp', 1100000, 0, 'Hàng mới', './Image/Products/Balo/BaloTayCamNhun.jpg'),
('Tui24', 'Túi Xách Lớn Tote Lớn Form Mềm', 'Túi lớn', 'Túi Xách Lớn Tote Lớn Form Mềm hiện đại. Form mềm bo góc cách điệu, quai đeo xách nữ tính. Phối dây rút giả cùng khóa kim lại nổi bật, phù hợp với nhiều phong cách. Chất liệu da tổng hợp dễ bảo quản.', 1100000, 0, 'Hàng mới', './Image/Products/TuiLon/TuiToteLonFormMem.jpg'),
('Tui25', 'Túi xách lớn Tote Bag phối lưới xuyên thấu', 'Túi lớn', 'Túi xách lớn Tote Bag phối lưới xuyên thấu thời trang. Khoang túi bên trong rộng rãi, tặng kèm ví tiện lợi, cho bạn thoải mái đựng những vận dụng cần thiết. Chất liệu da tổng hợp cao cấp bền đẹp, dễ vệ sinh.', 950000, 10, 'Hàng giảm giá', './Image/Products/TuiLon/TuiTotePhoiLuoiXuyenThau.jpg'),
('Tui26', 'Ví có dây kéo khóa trang trí', 'Ví-Clutch', 'Ví có dây kéo khóa trang trí thời trang, nổi bật. Thiết kế cứng cáp, khóa kim loại, tiện dụng dễ dàng sử dụng. Bên trong thiết kế nhiêu ngắn nhỏ, tiện dụng. Chất liệu jean và da tổng hợp cao cấp. Ví phù hợp dùng như ví tiền hoặc đi tiệc, dạo phố.\r\n', 355000, 0, 'Hàng thường', './Image/Products/Vi-Clutch/ViKeoKhoaTrangTri.jpg'),
('Tui27', 'Ví Nắp Gập in họa tiết chuyển màu', 'Ví-Clutch', 'Sành điệu, thiết kế nắp gập khóa bấm, bề mặt in chuyển màu cực kì nỗi bật. Khóa kéo kim loại mượt, bền đẹp và tiện dụng khi sử dụng. Chất liệu da tổng hợp dễ bảo quản.\r\n', 535000, 20, 'Hàng giảm giá', './Image/Products/Vi-Clutch/ViNapGap.jpg'),
('Tui28', 'Ví có dây đeo Cycling', 'Ví-Clutch', 'Thanh lịch, hiện đại, bên trong có nhiều ngăn nhỏ, tiện dụng. Chất liệu da tổng hợp cao cấp, phù hợp như ví tiền hoặc đi tiệc, dạo phố.\r\n', 600000, 1, 'Hàng thường', './Image/Products/Vi-Clutch/ViCoDayDeo-Cycling.jpg'),
('Tui29', 'Túi Xách Lớn Tote Lớn Phối Ngăn Trang Trí', 'Túi lớn', 'Túi xách lớn tote lớn phối ngăn trang trí hiện đại, thanh lịch. Khoang túi bên trong rộng rãi, có nhiều ngăn nhỏ cùng ví nhỏ tặng kèm giúp việc sắp xếp ngăn nắp, tiện dụng. Chất liệu da tổng hợp cao cấp bền đẹp.', 1099000, 0, 'Hàng hot', './Image/Products/TuiLon/TuiXach1NganTruoc.jpg'),
('Tui30', 'BaloUnisex', 'Balo', 'Balo tối giản phối hoạ tiết ô vuông lạ mắt. Bên trong có một ngăn lớn rộng, đựng được nhiều vận dụng cần thiết và phối khóa kéo tiện dụng. Chất liệu da tổng hợp cao cấp bền đẹp, dễ vệ sinh.', 1500000, 50, 'Hàng giảm giá', './Image/Products/Balo/BaloUnisex.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `TenDN` varchar(50) NOT NULL,
  `HoTen` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `SDT` varchar(15) NOT NULL,
  `DiaChi` varchar(30) NOT NULL,
  `MatKhau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`TenDN`, `HoTen`, `Email`, `SDT`, `DiaChi`, `MatKhau`) VALUES
('NamKhanh', 'Doãn Nam Khánh', 'khanh@gmail.com', '0135791112', 'Hà Nội', '123'),
('TienAnh', 'Trần Tiến Anh', 'tienanh@gmail.com', '0123456789', 'Hà Nội', '123'),
('Trung', 'Nguyễn Thành Trung', 'trung@gmail.com', '0246810121', 'Hà Nội', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`TenAdmin`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`TenDN`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Indexes for table `homthu`
--
ALTER TABLE `homthu`
  ADD PRIMARY KEY (`STT`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`TenDN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `homthu`
--
ALTER TABLE `homthu`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`TenDN`) REFERENCES `user` (`TenDN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
