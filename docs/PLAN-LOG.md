# 📋 VINACOS.VN REBUILD — Plan Log

> **Mô tả dự án**: Rebuild trang web **VINACOS.VN** (Gia công mỹ phẩm OEM/ODM sạch chuẩn khoa học).  
> **Tham chiếu giao diện & hiệu ứng**: [unila.com.vn](https://unila.com.vn/) (Clone 99-100% layout, hiệu ứng, pixel-perfect).  
> **Tham chiếu nội dung**: [labcos.com.vn](https://labcos.com.vn/gia-cong-my-pham/) (Gia công mỹ phẩm A-Z, R&D, công thức, nhà máy FDA/GMP).  
> **Khởi tạo**: 2026-07-24 **Cập nhật lần cuối**: 2026-07-25  
> **Progress**: Đã hoàn thành 100% Trang chủ Unila Clone (8 Sections), SCSS Design System & CLI Seeder. Đang thực hiện Phase Inner Pages & Brand Modules.

---

## Ký Hiệu Trạng Thái

| Icon | Trạng thái                               |
| ---- | ---------------------------------------- |
| ⬜   | Chưa bắt đầu                             |
| 🔄   | Đang làm                                 |
| ✅   | Hoàn thành                               |
| ⏸️   | Tạm dừng                                 |
| ❌   | Huỷ / Không cần                          |
| 🆕   | Task phát sinh (không có trong plan gốc) |

---

## THÁNG 1 — Project Migration & Clean Up

### Tuần 1: Project Setup & Namespace Cleanup

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 1   | Clone theme `spl` từ DailyXeDien sang VINACOS  | 🔴 Cao  | ✅         | 2026-07-24 | Thiết lập môi trường Laragon local        |
| 2   | Dọn dẹp code thừa & style cũ của ngành xe điện | 🔴 Cao  | ✅         | 2026-07-24 | Giữ theme sạch sẽ chuẩn bị cho mỹ phẩm   |
| 3   | Cấu hình `composer.json` & autoload            | 🟡 TB   | ✅         | 2026-07-24 | PHP >=8.1+                                |
| 4   | Cấu hình `pnpm` & `vite` build pipeline        | 🔴 Cao  | ✅         | 2026-07-24 | pnpm build verified 100%                  |

---

## THÁNG 2 — Flexible ACF & Unila Homepage Rebuild (100% Clone)

### Tuần 1: ACF Flexible Content Schema

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 5   | Cấu hình ACF schema `group_daily_home.json`    | 🔴 Cao  | ✅         | 2026-07-24 | Layouts linh hoạt `home_sections`         |
| 6   | Viết CLI Seeder script `populate-home-vinacos` | 🔴 Cao  | ✅         | 2026-07-24 | Auto populate dữ liệu chuẩn vào ACF fields|

### Tuần 2: High-Fidelity Homepage Template Parts

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 7   | Code `hero-slider.php`                         | 🔴 Cao  | ✅         | 2026-07-24 | Swiper Key Visual banner, split title     |
| 8   | Code `about-section.php`                       | 🔴 Cao  | ✅         | 2026-07-24 | TÂM THẾ CỘNG SỰ (Tầm nhìn & Sứ mệnh)      |
| 9   | Code `rd-system.php`                           | 🔴 Cao  | ✅         | 2026-07-24 | HỆ THỐNG R&D & Bài báo khoa học (Dual tab)|
| 10  | Code `key-numbers.php`                         | 🔴 Cao  | ✅         | 2026-07-24 | Con số nổi bật + count-up animation JS    |
| 11  | Code `product-showcase.php`                    | 🔴 Cao  | ✅         | 2026-07-24 | Danh mục sản phẩm VINACOS (Dual Swiper)   |
| 12  | Code `partners-section.php`                    | 🔴 Cao  | ✅         | 2026-07-24 | ĐỐI TÁC NGUYÊN LIỆU & NGHIÊN CỨU          |
| 13  | Code `news-section.php`                        | 🔴 Cao  | ✅         | 2026-07-24 | Tin tức mỹ phẩm & xu hướng                |
| 14  | Code `consult-modal.php`                       | 🔴 Cao  | ✅         | 2026-07-24 | Pop-up tư vấn Product Insight             |
| 15  | Cập nhật controller `template-page-home.php`   | 🔴 Cao  | ✅         | 2026-07-24 | Render linh hoạt theo ACF & fallback      |

---

## THÁNG 3 — Inner Pages, Brand Modules & Performance Optimization

### Tuần 1: Modern SCSS & Typography

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 16  | Code `_unila-home.scss`                        | 🔴 Cao  | ✅         | 2026-07-24 | Style chuẩn 100% pixel-perfect Unila      |
| 17  | Tích hợp font `Be Vietnam Pro` & `Playball`    | 🟡 TB   | ✅         | 2026-07-24 | Typography hiện đại, mượt mà              |
| 18  | Code nút bấm `btn-lined`                       | 🟢 Thấp | ✅         | 2026-07-24 | Nút bo tròn hover hiệu ứng đen/trắng      |

### Tuần 2: PageSpeed & Core Web Vitals (CWV)

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 19  | Thẻ `fetchpriority="high"` cho LCP image       | 🔴 Cao  | ✅         | 2026-07-24 | Banner slide 1 không bị delay LCP         |
| 20  | Thẻ `loading="lazy"` & kích thước explicit     | 🔴 Cao  | ✅         | 2026-07-24 | Khai báo `width`/`height` chống CLS        |
| 21  | Count-Up Observer JS                           | 🟡 TB   | ✅         | 2026-07-24 | Tự động chạy số khi scroll tới            |
| 22  | Asset bundling & minification                  | 🔴 Cao  | ✅         | 2026-07-24 | pnpm build minified CSS & JS               |

### Tuần 3: Header Navigation & Brand Identity (Hiện tại)

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 23  | Chuẩn hoá Header menu & Logo VINACOS           | 🔴 Cao  | 🔄         | 2026-07-25 | Nav: Tâm thế cộng sự, Sản phẩm, R&D...    |
| 24  | Chuẩn hoá Plan Log cho VINACOS                 | 🔴 Cao  | ✅         | 2026-07-25 | Đồng bộ tài liệu roadmap VINACOS.VN       |

### Tuần 4: Inner Pages & Cosmetic Brand Modules

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 25  | Trang Giới Thiệu (About Us)                    | 🔴 Cao  | ⬜         | —          | Template `page-about.php` GMP/FDA         |
| 26  | Trang Hệ Thống R&D & Bài Báo Khoa Học          | 🔴 Cao  | ⬜         | —          | Template `page-rd.php` 300+ công thức     |
| 27  | Trang Dịch Vụ Gia Công OEM/ODM (Labcos)        | 🔴 Cao  | ⬜         | —          | Template `page-oem-odm.php` A-Z           |
| 28  | WooCommerce Catalog & Chi Tiết Sản Phẩm        | 🟡 TB   | ⬜         | —          | Thành phần, công dụng, công bố Y tế       |
| 29  | AJAX Consult Form Product Insight              | 🔴 Cao  | ⬜         | —          | Form đăng ký nhận báo giá & tư vấn        |

---

## THÁNG 4 — SEO Technical, Caching & Production Launch

| #   | Công việc                                      | Ưu tiên | Trạng thái | Ngày       | Ghi chú                                   |
| --- | ---------------------------------------------- | ------- | ---------- | ---------- | ----------------------------------------- |
| 30  | JSON-LD Schema (Organization, Product...)      | 🔴 Cao  | ⬜         | —          | Rich Snippets mỹ phẩm & nhà máy           |
| 31  | Nginx FastCGI & Redis Object Cache             | 🔴 Cao  | ⬜         | —          | Tối ưu Server Performance                 |
| 32  | QA Testing & Deploy Production aaPanel         | 🔴 Cao  | ⬜         | —          | Mobile PageSpeed ≥75, Desktop ≥92         |

---

## Báo Cáo Nghiệm Thu & Kiểm Thử (Verification Log)

1. **PHP Syntax Check**: Tất cả file template parts và controller đều qua kiểm tra syntax không lỗi (`php -l`).
2. **ACF Data Import**: Đã thực thi script CLI `populate-home-vinacos.php` gán tự động toàn bộ dữ liệu mẫu OEM/ODM Mỹ phẩm vào Trang chủ (Page ID: 10).
3. **Asset Compilation**: Đã chạy `pnpm build` biên dịch thành công 100% không cảnh báo.
4. **Roadmap Synchronization**: Đã cập nhật `PLAN-LOG.md` và `VINACOS-SOURCE-OF-TRUTH.md` chính xác cho dự án VINACOS.VN.
