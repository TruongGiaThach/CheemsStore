<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        $products = [
            [
                'name' => "Chuột máy tính A4TECH N300 (Đen)",
                'image' => "mouse_black_A4.webp",
                'amount' => 10,
                'importPrice' => 80000,
                'outportPrice' => 90000,
                'manufacture' => "A4 TECH",
                'warrantyPeriod' => 12,
                'category_id' => "cate8",
                'description' => "Chuột máy tính A4 N300 là dòng sản phẩm cao cấp của hãng phụ kiện nổi tiếng A4tech. Đây là một công cụ cần thiết cho các dòng máy tính giúp người dùng có trải nghiệm tốt nhất.
                Độ nhạy cao: Với độ phân giải quang học lên tới 1000Dpi, giúp chuột không dây của bạn tăng độ nhạy với thiết bị kết nối, phù hợp khi dùng chơi game FPS, lượt web được mượt mà và nhanh chóng.
                Phạm vi sử dụng rộng: Chiều dài dây cáp lên tới 1.5 giúp bạn có thể sử dụng linh hoạt vào tiện lợi. Phù hợp khi sử dụng màn hình rộng hoặc case máy tính đặt ở dưới hay ở trên bàn làm việc.
                Mắt quang học nhay bén, dùng được trên nhiều loại mặt phẳng khác. Vẫn có thể hoạt động tốt nếu bám bụi.",
                'tag' => "[chuột, A4 Tech, Đen]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Chuột máy tính không dây Logitech M185 (Xám)",
                'image' => "mouse_gray_logitech.webp",
                'amount' => 10,
                'importPrice' => 220000,
                'outportPrice' => 234000,
                'manufacture' => "LOGITECH",
                'warrantyPeriod' => 12,
                'category_id' => "cate8",
                'description' => "Chuột máy tính Logitech M185 (Xám) là dòng sản phẩm cao cấp của hãng phụ kiện nổi tiếng A4tech. Đây là một công cụ cần thiết cho các dòng máy tính giúp người dùng có trải nghiệm tốt nhất.
                Độ nhạy cao: Với độ phân giải quang học lên tới 1000Dpi, giúp chuột không dây của bạn tăng độ nhạy với thiết bị kết nối, phù hợp khi dùng chơi game FPS, lướt web mượt mà và nhanh chóng.


                Phạm vi sử dụng rộng, sóng không dây tần số 2.4GHz, cho phạm vi sử dụng lên tới 10m
                Mắt quang học nhạy bén, dùng được trên nhiều loại mặt phẳng khác. Vẫn có thể hoạt động tốt nếu bám bụi.
                Phím bấm cùng với nút cuộn được thiết kế bền vững, cho những lần ấn chuột dứt khoát, không bị kẹt hay hỏng khi dùng lâu đặc biệt là khi chơi game bắn súng hay moba phải ấn nhanh, nhiều. Nút cuộn trơn tru không bị cảm giác gai, kẹt.


                Khi sử dụng Chuột máy tính Logitech M185 (Xám), người dùng không cần cài đặt driver, trình điều khiển, hay bất kì phần mềm hỗ trợ nào, chỉ cần kết nối thiết bị phát thông qua cổng USB là có thể sử dụng ngay lập tức.",
                'tag' => "[chuột, logitech, Xám]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Màn hình LCD ACER K222HQL (1920 x 1080/TN/60Hz/5 ms)",
                'image' => "lcd_screen.webp",
                'amount' => 10,
                'importPrice' => 3000000,
                'outportPrice' => "3199000",
                'manufacture' => "Cheems",
                'warrantyPeriod' => 36  ,
                'category_id' => "cate8",
                'description' => "- Kích thước: 21.5inche (1920 x 1080), Tỷ lệ 16:9
                - Tấm nền TN, Góc nhìn: 90 (H) / 65 (V)
                - Tần số quét: 60Hz , Thời gian phản hồi 5 ms
                - HIển thị màu sắc: 16.7 triệu màu
                - Cổng hình ảnh: , 1 x HDMI, 1 x DVI-D, 1 x VGA/D-sub",
                'tag' => "[pc, màn hình, tv, lcd]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Keycap Bàn phím Corsair PBT Double-shot (CH-9000234-NA) (Trắng)",
                'image' => "keycap_white.webp",
                'amount' => 10,
                'importPrice' => 1000000,
                'outportPrice' => "1400000",
                'manufacture' => "CORSAIR",
                'warrantyPeriod' => 12,
                'category_id' => "cate9",
                'description' => "Đang cập nhật",
                'tag' => "[bàn phím, keycap, pc]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Bàn phím Gaming E-DRA EK502 (Đen)",
                'image' => "erakeyboard_grey.webp",
                'amount' => 10,
                'importPrice' => 180000,
                'outportPrice' => 199000,
                'manufacture' => " E-Dra",
                'warrantyPeriod' => 12,
                'category_id' => "cate9",
                'description' => "- Bàn phím thường
                - Kết nối: USB 2.0
                - Phím chức năng: Có",
                'tag' => "[bàn phím, pc, gaming]",
                'created_at' => "12/10/2013"
            ],
            [
                'name' => "Bàn phím + Chuột Logitech MK120",
                'image' => "keyboard_mouse_logitech.webp",
                'amount' => 10,
                'importPrice' => 200000,
                'outportPrice' => "600000",
                'manufacture' => "Logitech",
                'warrantyPeriod' => 12,
                'category_id' => "cate9",
                'description' => "- Kiểu: Bàn phím thường
                - Kiểu kết nối: Có dây
                - Màu sắc: Đen",
                'tag' => "[chuột, bàn phím, pc, logitech]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Tai nghe Over-ear SoundMAX AH 304 (Đen)",
                'image' => "tainghe_overear.webp",
                'amount' => 10,
                'importPrice' => 202000,
                'outportPrice' => "500000",
                'manufacture' => " SOUNDMAX",
                'warrantyPeriod' => 12,
                'category_id' => "cate10",
                'description' => "- Thiết Kế: Over Ear (trùm kín quanh tai)
                - Kết Nối: Jack 3.5mm (audio) / Jack 3.5mm (mic)
                - Chức Năng: Volume Control
                - Tai nghe Audio với kiểu dáng sang trọng, thanh lịch đem đến cho bạn một âm thanh rõ ràng, tách bạch",
                'tag' => "[tai nghe, pc]",
                'created_at' => "12/9/2013"
            ],
            [
                'name' => "Cáp chuyển Soundmax Jack gộp Mic & Audio",
                'image' => "cap_chuyen_1.webp",
                'amount' => 10,
                'importPrice' => 100000,
                'outportPrice' => "120000",
                'manufacture' => "SOUNDMAX",
                'warrantyPeriod' => 12,
                'category_id' => "cate10",
                'description' => "Đầu chuyển gộp cổng Audio và Micro dành cho điện thoại, Laptop không có cổng Micro riêng biệt",
                'tag' => "[pc, cáp, laptop]",
                'created_at' => "12/10/2013"
            ],
            [
                'name' => "Loa 5.1 Logitech Z906 (Đen)",
                'image' => "Loa_Logitech_906_Đen.webp",
                'amount' => 10,
                'importPrice' => 5000000,
                'outportPrice' => 6000000,
                'manufacture' => " LOGITECH",
                'warrantyPeriod' => 36,
                'category_id' => "cate10",
                'description' => "Thiết Kế: Hệ Thống Loa 5.1
                - Kết Nối: Jack 3.5mm (headphone) / Jack 3.5mm (input) / RCA (input) / Jack 3.5 (surround input) / Coaxial (input) / Optical (input) / Push Ternminal (output)
                - Chức Năng: Volume Control / Bass Control / 2.1 Mode / 4.1 Mode / 3D Mode / DTS Interative / Dolby Digital / THX / Loa treo tường được
                - Công Suất: 500W RMS",
                'tag' => "[loa, pc, laptop]",
                'created_at' => "12/9/2013"
            ],
            [
                'name' => "Ống kính Fujifilm XF23mm F1.4 R",
                'image' => "ong_kinh_Fujifilm_XF23mm_F1_4_R.webp",
                'amount' => 10,
                'importPrice' => 18000000,
                'outportPrice' => 20000000,
                'manufacture' => "Fujifilm",
                'warrantyPeriod' => 36,
                'category_id' => "cate11",
                'description' => "- Thương hiệu: Fujifilm
                - Độ phân giải:
                - Tiêu cự: 11 thấu kính chia làm 8 nhóm
                - Zoom: 0.1x /
                - Bảo hành chính hãng: 18 tháng",
                'tag' => "[máy ảnh, ống kính]",
                'created_at' => "12/11/2013"
            ],
            [
                'name' => "Máy ảnh Canon EOS 200D II Kit 18-55 BK",
                'image' => "10044644-may-anh-canon-eos-200d-ii-kit-18-55mm-den-1.jpg",
                'amount' => 10,
                'importPrice' => 15000000,
                'outportPrice' => 17000000,
                'manufacture' => "Cannon",
                'warrantyPeriod' => 48,
                'category_id' => "cate11",
                'description' => "Cảm biến APS-C CMOS 24.1MP đáp ứng tốt nhu cầu chụp
                Dual Pixel CMOS AF phản hồi lấy nét trong thời gian ngắn
                Tốc độ cửa trập 30 - 1/4000s, nhanh chóng bắt sáng
                Tích hợp Wifi và Bluetooth, dễ dàng chia sẻ hình ảnh
                Bộ xử lí ảnh DIGIC 8, cho chất lượng ảnh tuyệt hảo
                Dải ISO rộng 100-25600 linh hoạt điều chỉnh
                Màn hình cảm ứng Vari-Angle giúp thao tác cực nhạy
                Chế độ quay phim 4K tái hiện hình ảnh chân thực
                Vỏ máy với sắc đen hiện đại, dễ dàng vệ sinh máy",
                'tag' => "[máy ảnh, DSLR, trả góp]",
                'created_at' => "12/9/2013"
            ],
            [
                'name' => "Máy ảnh Canon 750D kit 18-55mm",
                'image' => "cannon_mayanhco_5.jpeg",
                'amount' => 10,
                'importPrice' => 5000000,
                'outportPrice' => 6000000,
                'manufacture' => "Cannon",
                'warrantyPeriod' => 36,
                'category_id' => "cate11",
                'description' => "Máy ảnh Canon EOS 750D là một trong hai mẫu máy dòng ba số mới của Canon đưa ra thị trường. Nhìn bề ngoài và các tính năng hoạt động có thế dễ dàng thấy 750D không có sự khác biệt so với người anh em 700D. Nhưng những thay đổi bên trong của 750D thì thật sự đáng giá, cảm biến vủa 750D có độ phân giả 24Mp, tốc độ lấy nét nhanh hơn và đặc biệt được tích hợp tính năng Wifi.",
                'tag' => "[máy ảnh, máy ảnh cơ, cannon]",
                'created_at' => "12/11/2013"
            ],
            [
                'name' => "Máy lọc không khí (AIR PURIFIER) XIAOMI MI PRO/ EU (FJY4013GL) (Trắng)",
                'image' => "mlkk1.webp",
                'amount' => 5,
                'importPrice' => 2200000,
                'outportPrice' => 5299000,
                'manufacture' => "XIAOMI",
                'warrantyPeriod' => 24,
                'category_id' => "cate1",
                'description' => "Sử dụng bộ lọc bụi thô, lọc mùi than hoạt tính và bộ lọc HEPA, lọc được bụi mịn PM2.5. Thiết kế hình trụ, lấy không khí từ 3 chiều, tăng hiệu quả lọc cho diện tích phòng 35 – 60 m2. Có cảm biến bụi, cảm biến ánh sáng và đèn báo chất lượng không khí. Hỗ trợ điều khiển bằng giọng nói, điều khiển qua điện thoại với ứng dụng Mi Home.",
                'tag' => "[Máy lọc không khí, XIAOMI]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Máy lọc không khí Daikin MC40UVM6",
                'image' => "mlkk3.webp",
                'amount' => 12,
                'importPrice' => 2999000,
                'outportPrice' => 6999000,
                'manufacture' => "Daikin",
                'warrantyPeriod' => 36,
                'category_id' => "cate1",
                'description' => "Thiết kế nhỏ gọn. Cảm biến PM2.5 và hiển thị chất lượng không khí.Hệ thống phin lọc 3 cấp",
                'tag' => "[Máy lọc không khí, Daikin]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Máy lọc không khí Daikin MC55UVM6",
                'image' => "mlkk2.webp",
                'amount' => 7,
                'importPrice' => 2400000,
                'outportPrice' => 6459000,
                'manufacture' => "Daikin",
                'warrantyPeriod' => 36,
                'category_id' => "cate1",
                'description' => "Phin lọc tĩnh điện HEPA. Công nghệ streamer. Công nghệ ion plasma. Cảm biến nhanh chóng phát hiện bụi PM 2.5. Hút gió mạnh mẽ với độ ồn thấp",
                'tag' => "[Máy lọc không khí, Daikin]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Laptop Acer Nitro 5 AN515-52-51LW (NH.Q3LSV.002) (15.6inch FHD/i5-8300H/8GB/1TB HDD/GTX 1050Ti/Linux/2.4 kg)",
                'image' => "laptop-acer-nitro.webp",
                'amount' => 10,
                'importPrice' => 20040000,
                'outportPrice' => 24040000,
                'manufacture' => "ACER",
                'warrantyPeriod' => 24,
                'category_id' => "cate2",
                'description' => "- CPU: Intel Core i5-8300H ( 2.3 GHz - 4.0 GHz / 8MB / 4 nhân, 8 luồng ). Màn hình: 15.6inch IPS ( 1920 x 1080 ) , không cảm ứng. RAM: 1 x 8GB DDR4 2666MHz. Đồ họa: Intel UHD Graphics 630 / NVIDIA GeForce GTX 1050Ti 4GB GDDR5. Lưu trữ: 128GB SSD M.2 SATA / 1TB HDD 5400RPM. Hệ điều hành: Linux. Pin: 4 cell 48 Wh Pin liền , khối lượng: 2.4 kg",
                'tag' => "[Laptop, ACER]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Laptop Acer Spin 3 SP314-51-51LE (NX.GZRSV.002) (14inch FHD/i5-8250U/4GB/UHD 620/Win10/1.7 kg)",
                'image' => "laptop-acer-spin.webp",
                'amount' => 8,
                'importPrice' => 13400000,
                'outportPrice' => 16400000,
                'manufacture' => "ACER",
                'warrantyPeriod' => 24,
                'category_id' => "cate2",
                'description' => "CPU: Intel Core i5-8250U ( 1.6 GHz - 3.4 GHz / 6MB / 4 nhân, 8 luồng ). Màn hình: 14inch IPS ( 1920 x 1080 ) , cảm ứng. RAM: 1 x 4GB Onboard DDR4 2400MHz. Đồ họa: Intel UHD Graphics 620. Lưu trữ: 256GB SSD M.2 SATA. Hệ điều hành: Windows 10 Home SL 64-bit. Pin: 3 cell 61 Wh Pin liền , khối lượng: 1.7 kg",
                'tag' => "[Laptop, ACER]"
                ,
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Laptop Dell Vostro 14 3405 V4R53500U001W ( 14inch Full HD/AMD Ryzen 5 3500U/4GB/256GB SSD/Windows 10 Home SL 64-bit/1.7kg)",
                'image' => "laptop-dell.webp",
                'amount' => 22,
                'importPrice' => 13190000,
                'outportPrice' => 16190000,
                'manufacture' => "Dell",
                'warrantyPeriod' => 12,
                'category_id' => "cate2",
                'description' => "- CPU: AMD Ryzen 5 3500U. Màn hình: 14inch WVA (1920 x 1080). RAM: 1 x 4GB DDR4 2400MHz. Đồ họa: AMD Radeon Vega 8 Graphics. Lưu trữ: 256GB SSD M.2 NVMe /. Hệ điều hành: Windows 10 Home SL 64-bit. Pin: 3 cell 42 Wh Pin liền. Khối lượng: 1.7 kg",
                'tag' => "[Laptop, Dell]",
                'created_at' => "12/8/2013"
            ],
            [
                'name' => "Smart Tivi Samsung 4K UHD 65 Inch UA65AU7700KXXV",
                'image' => "tv-samsung.webp",
                'amount' => 32,
                'importPrice' => 19490000,
                'outportPrice' => 21490000,
                'manufacture' => "SAMSUNG",
                'warrantyPeriod' => 24,
                'category_id' => "cate3",
                'description' => "Kích thước: 65inch. Độ phân giải: 3840 x 2160 / Ultra HD 4K. Hệ điều hành: Tizen. Kết nối mạng: LAN, WiFi, Bluetooth. Cổng xuất hình: 3 x HDMI",
                'tag' => "[Tv, Samsung]",
                'created_at' => "12/9/2013"
            ],
            [
                'name' => "Smart Tivi LG 4K 55 inch 55UP7550PTC (55inch)",
                'image' => "tv-lg.webp",
                'amount' => 10,
                'importPrice' => 12490000,
                'outportPrice' => 15490000,
                'manufacture' => "LG",
                'warrantyPeriod' => 24,
                'category_id' => "cate3",
                'description' => "Kích thước: 55inch. Độ phân giải: 3840 x 2160 / Ultra HD (4K). Hệ điều hành: WebOS. Kết nối mạng: LAN, WiFi, Bluetooth. Cổng xuất hình: 2 x HDMI",
                'tag' => "[Tv, LG]",
                'created_at' => "12/9/2013"
            ],
            [
                'name' => "Smart tivi Casper 4K 65 inch 65UG6000",
                'image' => "tv-casper.webp",
                'amount' => 24,
                'importPrice' => 15590000,
                'outportPrice' => 17490000,
                'manufacture' => "Casper",
                'warrantyPeriod' => 24,
                'category_id' => "cate3",
                'description' => "Kích thước: 65inch. Độ phân giải: 3840 x 2160 / Ultra HD (4K). Hệ điều hành: Android 9.0. Kết nối mạng: WiFi. Cổng xuất hình: 3 x HDMI",
                'tag' => "[Tv, Casper]",
                'created_at' => "12/9/2013"
            ],
            [
                'name' => "Điện Thoại Di Động Samsung Galaxy Note 10 (Aura Glow)",
                'image' => "dienthoai-samsung.webp",
                'amount' => 10,
                'importPrice' => 20000000,
                'outportPrice' => 22990000,
                'manufacture' => "SAMSUNG",
                'warrantyPeriod' => 24,
                'category_id' => "cate4",
                'description' => "Chính hãng, Mới 100%, Nguyên seal. Màn hình: 6.3inch Dynamic AMOLED. Camera sau: 16MP, 2x 12MP. Camera trước: 10MP. CPU: Exynos 9825. Bộ nhớ: 256GB. RAM: 8GB. Hệ điều hành: Android",
                'tag' => "[Điện thoại, SAMSUNG]",
                'created_at' => "12/10/2013"
            ],
            [
                'name' => "Kính thực tế ảo HTC Vive CE",
                'image' => "vr-htc.webp",
                'amount' => 2,
                'importPrice' => 12690000,
                'outportPrice' => 16690000,
                'manufacture' => "HTC",
                'warrantyPeriod' => 12,
                'category_id' => "cate4",
                'description' => "Phần cứng máy tính đề nghị. Card màn hình: NVIDIA GeForce GTX 1060 hoặc AMD Radeon RX 480, tương tự hoặc cao hơn.  . Vi xử lý (CPU): Intel Core i5-4590 hoặc AMD FX 8350, tương tự hoặc cao hơn. . Bộ nhớ: 4 GB RAM hoặc nhiều hơn - Video out: HDMI 1.4, DisplayPort 1.2 hoặc mới hơn.  . Cổng USB: 1x USB 2.0 hoặc tốt hơn.  . Hệ điều hành: Windows 7 SP1, Windows 8.1 hoặc mới hơn, Windows 10",
                'tag' => "[VR, HTC]",
                'created_at' => "12/10/2013"
            ],
            [
                'name' => "Đồng hồ thông minh FITBIT VERSA LITE CHARCOAL/SILVER (VN) (FB415SRGY)",
                'image' => "dongho-fitbit.webp",
                'amount' => 10,
                'importPrice' => 3000000,
                'outportPrice' => 3849000,
                'manufacture' => "FITBIT",
                'warrantyPeriod' => 12,
                'category_id' => "cate4",
                'description' => "Kết nối: Wifi, Bluetooth. Có chống nước 50M. Chất liệu mặt kính cường lực Gorilla Class 3. Cập nhật thông báo liên tục từ smartphone",
                'tag' => "[Đồng hồ, FITBIT]",
                'created_at' => "12/10/2013"
            ],
            [
                'name' => "PC Acer Aspire TC-865 (DT.BARSV.00A) (i3-9100/4GB/1TB HDD/UHD 630/Endless)",
                'image' => "pc-acer.webp",
                'amount' => 12,
                'importPrice' => 6690000,
                'outportPrice' => 9690000,
                'manufacture' => "ACER",
                'warrantyPeriod' => 24,
                'category_id' => "cate5",
                'description' => "CPU: Intel Core i3-9100 (3.6 GHz up to 4.20 GHz/6MB/4 nhân, 4 luồng). RAM: 1 x 4GB DDR4 2666MHz (2 Khe cắm, Hỗ trợ tối đa 32GB). Đồ họa: Intel UHD Graphics 630. Lưu trữ: 1TB HDD 7200RPM. Bàn phím + Chuột",
                'tag' => "[PC, ACER]",
                'created_at' => "12/10/2013"
            ],
            [
                'name' => "Màn hình LCD ACER K222HQL (1920 x 1080/TN/60Hz/5 ms)",
                'image' => "manhinh-pc.webp",
                'amount' => 6,
                'importPrice' => 2500000,
                'outportPrice' => 3190000,
                'manufacture' => "ACER",
                'warrantyPeriod' => 69,
                'category_id' => "cate6",
                'description' => "Kích thước: 21.5inch (1920 x 1080), Tỷ lệ 16:9. Tấm nền TN, Góc nhìn: 90 (H) / 65 (V). Tần số quét: 60Hz , Thời gian phản hồi 5 ms. HIển thị màu sắc: 16.7 triệu màu. Cổng hình ảnh: , 1 x HDMI, 1 x DVI-D, 1 x VGA/D-sub",
                'tag' => "[Màn hình, ACER]",
                'created_at' => "12/11/2013"
            ],
            [
                'name' =>"Ổ cứng di động HDD WD Black P10 Game Drive 2TB USB3.2 (WDBA2W0020BBK-WESN)",
                'image' =>"ocungdidonghdd.webp",
                'amount' =>100,
                'importPrice' =>2800000,
                'outportPrice' =>3200000,
                'manufacture' =>"WD",
                "warrantyPeriod" =>48,
                'category_id' =>"cate12",
                'description' =>"Ổ đĩa trò chơi WD_BLACK ™ P10 cung cấp cho bảng điều khiển hoặc PC của bạn các công cụ nâng cao hiệu suất cần thiết để giữ lợi thế cạnh tranh của bạn. Đây là ổ cứng gắn ngoài hàng đầu với dung lượng lên tới 5TB, được chế tạo dành riêng cho các game thủ muốn mở rộng tiềm năng của bảng điều khiển hoặc PC bằng cách lưu thư viện trò chơi của họ theo hình thức di chuyển. Giờ đây, với Ổ đĩa trò chơi WD_BLACK ™ P10, bạn có thể lái trò chơi của mình theo cách bạn chọn.",
                'tag' =>"[Ổ cứng, WD]",
                'created_at' =>"12/8/2020"
            ],
            [
                'name' =>"Adapter Xiaomi chuyển USB Type C sang VGA - Ethernet (JGQ4005TY)",
                'image' =>"adpterxiaomiusbtypeCsangVGA.webp",
                'amount' =>100,
                'importPrice' =>800000,
                'outportPrice' =>940000,
                'manufacture' =>"Xiaomi",
                "warrantyPeriod" =>69,
                'category_id' =>"cate12",
                'description' =>"Bộ chuyển đổi/ Adapter Xiaomi chuyển USB Type C sang VGA – Ethernet (JGQ4005TY) được thiết kế và sản xuất bởi hãng XIAOMI – là một công ty tư nhân của Trung Quốc, có trụ sở tại Bắc Kinh chuyên về thiết kế, phát triển và sản xuất điện thoại di động, điện thoại thông minh, máy tính bảng và một số thiết bị gia dụng khác được thành lập vào năm 2010.",
                'tag' =>"[USB, Xiaomi]",
                'created_at' =>"12/8/2020"
            ],
            [
                'name' =>"Cáp HDMI Unitek YC 110 (20m)",
                'image' =>"capHDMIunitekyc100.webp",
                'amount' =>100,
                'importPrice' =>1000000,
                'outportPrice' =>1700000,
                'manufacture' =>"Unitek",
                "warrantyPeriod" =>69,
                'category_id' =>"cate12",
                'description' =>"Cáp HDMI Unitek YC 110 (20m) là một sợi cáp nhỏ gọn, giúp bạn truyền tải cùng lúc cả âm thanh và hình ảnh lên những thiết bị trình chiếu lớn như tivi thông qua kết nối HDMI. Trước đây, người dùng thường gặp bất tiện khi truyền tải giải trí đa phương tiện đến màn hình lớn vì phải sử dụng 2 dây cáp VGA và AV. Sự cồng kềnh thậm chí bất cập vì sự “lệch khớp” của âm thanh – hình ảnh là điều không hiếm. Vì thế việc sử dụng cáp HDMI đã giúp giải quyết những nhược điểm trên.",
                'tag' =>"[Cáp, Unitek]",
                'created_at' =>"12/8/2020"
            ],
            [
                'name' =>"Giấy in bill 3 lliên K75x20m",
                'image' =>"giayinbill3.webp",
                'amount' =>100,
                'importPrice' =>20000,
                'outportPrice' =>50000,
                'manufacture' =>"Khác",
                "warrantyPeriod" =>69,
                'category_id' =>"cate12",
                'description' =>"Đặc tính của dòng giấy in : có chiều ngang 80mm – phù hợp với các máy in nhiệt có chiều rộng đầu in từ 75mm đến 80mm. Giấy có chất lượng cao, độ nét cao khi in, không có phụ gia nên không gây mòn đầu in của máy. Chuyên được sử dụng cho các dòng máy in nhiệt như là PRP 085, C230, EPSON TMT 88IV, EPSON TMT 81,...",
                'tag' =>"[Giấy, Khác]",
                'created_at' =>"12/8/2020"
            ],
            [
                'name' =>"Cáp Mạng Dintek 5e UTP (Thùng 300m)",
                'image' =>"capmangdintek5eUTP.webp",
                'amount' =>100,
                'importPrice' =>2000000,
                'outportPrice' =>2800000,
                'manufacture' =>"Dintek",
                "warrantyPeriod" =>69,
                'category_id' =>"cate13",
                'description' =>"Cáp UTP là sản phẩm tương thích cho việc kết nối mạng đến mọi nhà phổ biến nhất. Mức giá của loại cáp này khá rẻ mà chất lượng vẫn rất tốt. Cáp Cat5e được hình thành bởi 4 cặp dây xoắn với nhau có tác dụng giảm độ nhiễu và bức xạ khi nằm cạnh những thiết bị điện tử khác và được bao bọc bởi lớp vỏ nhựa PVC. Dây cáp được thiết kế cực kì mỏng nhẹ nhưng rất chắc chắn. Trên dây dẫn có in các thông tin cần thiết cho khách hàng sử dụng.",
                'tag' =>"[Cáp, Dintek]",
                'created_at' =>"12/8/2019"
            ],
            [
                'name' =>"Thiết bị quan sát/Camera hành động 3SIXT DV123SANC-3S",
                'image' =>"camerahanhdong2sixtdv123sanc.webp",
                'amount' =>100,
                'importPrice' =>2000000,
                'outportPrice' =>2800000,
                'manufacture' =>"Khác",
                "warrantyPeriod" =>48,
                'category_id' =>"cate13",
                'description' =>"Đang cập nhật",
                'tag' =>"[camera, Khác]",
                'created_at' =>"12/8/2019"
            ],
            [
                'name' =>"Router Wifi TPLink TL-WR940N",
                'image' =>"routewifitplinkTlwr.webp",
                'amount' =>50,
                'importPrice' =>400000,
                'outportPrice' =>500000,
                'manufacture' =>"TPLINK",
                "warrantyPeriod" =>48,
                'category_id' =>"cate13",
                'description' =>"Router không dây chuẩn N TL-WR940N tốc độ 450Mbps là một thiết bị kết nối mạng kết hợp tính năng không dây/có dây được thiết kế đặc biệt để phục vụ cho nhu cầu sử dụng mạng trong nhà và văn phòng nhỏ. Được tích hợp công nghệ MIMO, thiết bị này có thể tạo ra một hiệu suất truyền tải không dây tiên tiến và rất đặc biệt, qua đó giúp cho người dùng có được một sự lựa chọn sáng suốt khi họ muốn xem các video HD trực tuyến, thực hiện các cuộc gọi VoIP và chơi game trực tuyến.",
                'tag' =>"[camera, TPLINK]",
                'created_at' =>"12/8/2019"
            ],
            [
                'name' =>"Thiết bị ghi hình/ Webcam Logitech BCC950",
                'image' =>"wbcamlogitechBC950.webp",
                'amount' =>50,
                'importPrice' =>5000000,
                'outportPrice' =>6000000,
                'manufacture' =>"Logitech",
                "warrantyPeriod" =>48,
                'category_id' =>"cate13",
                'description' =>"Tương thích với cả máy tính và máy Mac và được thiết kế để hoạt động với nhiều ứng dụng phần mềm hội nghị truyền hình, BCC950 khiến cho việc bắt đầu làm việc qua video trong nhóm nhỏ nhanh chóng và dễ dàng. Không cần đào tạo.",
                'tag' =>"[Webcam, Logitech]",
                'created_at' =>"12/8/2018"
            ],
            [
                'name' =>"Loa hội nghị Yealink CP700",
                'image' =>"loahoinghiyealingcp700.webp",
                'amount' =>30,
                'importPrice' =>4000000,
                'outportPrice' =>5000000,
                'manufacture' =>"Logitech",
                "warrantyPeriod" =>48,
                'category_id' =>"cate13",
                'description' =>"Loa Yealink CP700 là dòng loa sử dụng cho phòng họp. Loa có thiết kế dạng tròn thanh lịch cùng chân chống. Loa có nhiều cổng kết nối thuận tiện cho việc sử dụng cùng nhiều thiết bị khác nhau, thậm chí là với điện thoại của bạn.",
                'tag' =>"[Loa, Yealink]",
                'created_at' =>"12/8/2018"
            ],
        ];
        DB::table('products')->insert($products);
    }
}
