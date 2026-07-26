# VINACOS Source Of Truth

> **Khởi tạo**: 2026-07-24  
> **Cập nhật**: 2026-07-25  
> **Dự án**: Rebuild VINACOS.VN (Gia công mỹ phẩm OEM/ODM sạch chuẩn khoa học)

---

## 🎯 Mô Tả Dự Án & Tham Chiếu

| Hạng mục | Nguồn / URL | Mục đích sử dụng |
|----------|-------------|------------------|
| **Brand chính** | **VINACOS.VN** | Thương hiệu sản xuất & gia công mỹ phẩm sạch chuẩn khoa học tại Việt Nam |
| **Giao diện & Hiệu ứng** | [unila.com.vn](https://unila.com.vn/) | **Clone 99-100%** layout, typography, hiệu ứng Swiper/Count-up, UI pixel-perfect |
| **Nội dung & Dịch vụ** | [labcos.com.vn](https://labcos.com.vn/gia-cong-my-pham/) | Tham chiếu nội dung gia công OEM/ODM A-Z, quy trình R&D, tiêu chuẩn FDA/GMP |

---

## 🏢 Thông Tin Thương Hiệu & Pháp Lý VINACOS

| Trường thông tin | Giá trị chuẩn |
|------------------|---------------|
| **Tên thương hiệu** | VINACOS — Mỹ Phẩm Việt Chuẩn Khoa Học |
| **Lĩnh vực hoạt động** | Nghiên cứu R&D, Sản xuất & Gia công Mỹ phẩm OEM/ODM/OBM |
| **Slogan** | MỞ LỐI KỶ NGUYÊN MỸ PHẨM VIỆT CHUẨN KHOA HỌC |
| **Tiêu chuẩn nhà máy** | Đạt chuẩn GMP - Bộ Y tế, Tiêu chuẩn FDA Hoa Kỳ |
| **Cam kết** | 0% Hoạt chất cấm — 100% Thử nghiệm độ ổn định & Kiểm nghiệm lâm sàng |
| **Hotline tư vấn** | 0900.xxx.xxx |
| **Email hỗ trợ** | contact@vinacos.vn |
| **Website** | https://vinacos.vn / http://vinacos.test (Local) |

---

## 📦 Danh Mục Sản Phẩm & Dịch Vụ Cốt Lõi

### 1. Dịch vụ Gia công Mỹ phẩm (OEM / ODM / OBM)
- Gia công Serum / Essence chuyên sâu (Trắng da, Trị mụn, Phục hồi da, Anti-aging).
- Gia công Nền kem vỡ nước không Silicone (Đột phá công nghệ nhũ tương).
- Gia công Mặt nạ đất sét khoáng tự nhiên & Bùn khoáng Cúc La Mã.
- Gia công Tẩy tế bào chết Silica sinh học chiết xuất từ vỏ trấu Việt Nam.
- Gia công Dược mỹ phẩm chuẩn y khoa (Cho Clinic, Spa, Thẩm mỹ viện).

### 2. Hệ thống R&D & Năng lực Nghiên cứu
- **300+ Công thức độc quyền** đã qua thử nghiệm lâm sàng và kiểm định độ ổn định.
- **30+ Bài báo & Đề tài khoa học** công bố trên các tạp chí chuyên ngành.
- **Hợp tác nghiên cứu**: Trường Đại Học Công Thương & các đối tác uy tín.
- **Đối tác cung ứng nguyên liệu quốc tế**: Behn Meyer, Clariant, DSM, Seppic, Solabia, NOF, Oillio, CIDOLS.

---

## 🛠️ Quy Trình Triển Khai Kỹ Thuật

1. **Flexible Homepage**: Cấu hình ACF JSON `group_daily_home.json` cho 8 sections Unila.
2. **CLI Data Seeder**: Chạy script `populate-home-vinacos.php` nhập dữ liệu mỹ phẩm chuẩn vào DB.
3. **SCSS / CSS Architecture**: Biên dịch `_unila-home.scss` via Vite + PNPM.
4. **Core Web Vitals**: Thẻ `fetchpriority="high"` cho Slide 1 Hero LCP, `loading="lazy"` & kích thước explicit cho toàn bộ ảnh below-the-fold.
