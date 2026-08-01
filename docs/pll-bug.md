# Báo Cáo Khắc Phục Lỗi Module SPL Polylang

**Ngày thực hiện:** 29/07/2026  
**Dự án:** SPL / Vinacos  
**Môi trường:** WordPress 7.0.2 / PHP 8.3 / Laragon (`vinacos.test`)  

---

## Tổng Quan Vấn Đề

Trong quá trình refactor theme từ kiến trúc **HD Theme** sang **SPL Theme**, module tích hợp Polylang (`SPL\Modules\PLL`) còn tồn tại một số tham chiếu legacy đến các class/namespace cũ không tồn tại trong core của SPL Theme. Điều này dẫn đến các lỗi **Fatal Error (Uncaught Error)** khi người dùng truy cập trang quản trị Polylang (`Languages > Settings / SPL Polylang`).

---

## Chi Tiết Các Lỗi & Giải Pháp Khắc Phục

### 1. Bug 1: `Fatal Error: Class "SPL\Core\Environment" not found`

- **Trạng thái:** Đã khắc phục (Fixed)
- **Triệu chứng:**
  Khi truy cập trang `wp-admin/admin.php?page=mlang_hd_pll`, hệ thống báo lỗi Fatal Error:
  ```text
  Uncaught Error: Class "SPL\Core\Environment" not found
  in D:\laragon\www\vinacos\wp\wp-content\themes\spl\src\Modules\PLL\Admin\PLLSettings.php on line 111
  ```
- **Nguyên nhân gốc (Root Cause):**
  Trong quá trình phát triển module Polylang, các phương thức kiểm tra môi trường như `isWoocommerceActive()` và `isAcfActive()` được gọi thông qua class `SPL\Core\Environment`. Tuy nhiên, trong core SPL Theme, các helper này đã được hợp nhất vào static class `SPL\Core\Helper` (thông qua `SPL\Traits\Misc` và `SPL\Traits\WpAcf`). Class `Environment` không tồn tại trong namespace `SPL\Core`.
- **Các vị trí ảnh hưởng:**
  - `wp/wp-content/themes/spl/src/Modules/PLL/Admin/PLLSettings.php` (Dòng 17, 111)
  - `wp/wp-content/themes/spl/src/Modules/PLL/PLLModule.php` (Dòng 26, 156, 161, 217)
- **Giải pháp xử lý:**
  1. Đổi câu lệnh import: `use SPL\Core\Environment;` ➔ `use SPL\Core\Helper;`
  2. Thay thế toàn bộ các lời gọi phương thức:
     - `Environment::isWoocommerceActive()` ➔ `Helper::isWoocommerceActive()`
     - `Environment::isAcfActive()` ➔ `Helper::isAcfActive()`

---

### 2. Bug 2: `Fatal Error: Class "SPL\Support\FileSystem" not found`

- **Trạng thái:** Đã khắc phục (Fixed)
- **Triệu chứng:**
  Khi lưu cài đặt hoặc kích hoạt quét dịch thuật chuỗi (String Scanner), hệ thống báo lỗi Fatal Error:
  ```text
  Uncaught Error: Class "SPL\Support\FileSystem" not found
  in D:\laragon\www\vinacos\wp\wp-content\themes\spl\src\Modules\PLL\Translation\Scanner.php on line 266
  ```
- **Nguyên nhân gốc (Root Cause):**
  Hàm `extractStrings()` trong `Scanner.php` thực hiện đọc nội dung file source code để trích xuất các hàm dịch (`pll_e`, `pll__`, `__`, `_e`, `esc_html__`,...) và gọi tới class `SPL\Support\FileSystem::fileRead($file)`. Namespace `SPL\Support\FileSystem` không tồn tại trong cấu trúc thư mục của SPL Theme.
- **Các vị trí ảnh hưởng:**
  - `wp/wp-content/themes/spl/src/Modules/PLL/Translation/Scanner.php` (Dòng 18, 266)
- **Giải pháp xử lý:**
  1. Loại bỏ dòng import không hợp lệ: `use SPL\Support\FileSystem;`
  2. Thay thế lời gọi đọc file bằng utility method chính thức của theme:
     - `FileSystem::fileRead( $file )` ➔ `Helper::fileRead( $file )`  
     *(Hàm `Helper::fileRead()` sử dụng an toàn `WP_Filesystem` API để làm việc với tệp tin).*

---

### 3. Yêu cầu Cập nhật Thương hiệu (Branding): "HD Polylang" ➔ "SPL Polylang"

- **Trạng thái:** Đã hoàn thành (Done)
- **Mô tả:**
  Nhãn tab điều hướng và tiêu đề trang quản trị Polylang vẫn còn hiển thị thương hiệu cũ "HD Polylang".
- **Vị trí điều chỉnh:**
  - `wp/wp-content/themes/spl/src/Modules/PLL/Admin/PLLSettings.php` (Dòng 88, 95)
- **Giải pháp xử lý:**
  Cập nhật giá trị nhãn tab trong hàm `addTab()`:
  ```php
  public static function addTab( array $tabs ): array {
      $tabs[ self::TAB_SLUG ] = __( 'SPL Polylang', 'spl' );
      return $tabs;
  }
  ```

---

## Danh Sách Tệp Đã Thay Đổi

| Tệp tin | Loại thay đổi | Mô tả chi tiết |
|---|---|---|
| `wp/wp-content/themes/spl/src/Modules/PLL/Admin/PLLSettings.php` | Modify | Đổi `Environment` ➔ `Helper`, cập nhật nhãn tab ➔ **SPL Polylang**. |
| `wp/wp-content/themes/spl/src/Modules/PLL/PLLModule.php` | Modify | Đổi `Environment::isWoocommerceActive()` & `isAcfActive()` ➔ `Helper`. |
| `wp/wp-content/themes/spl/src/Modules/PLL/Translation/Scanner.php` | Modify | Đổi `FileSystem::fileRead()` ➔ `Helper::fileRead()`. |

---

## Kiểm Tra & Xác Nhận (Verification Results)

1. **Lint Check (Cú pháp PHP):**
   ```bash
   php -l wp/wp-content/themes/spl/src/Modules/PLL/Admin/PLLSettings.php
   php -l wp/wp-content/themes/spl/src/Modules/PLL/PLLModule.php
   php -l wp/wp-content/themes/spl/src/Modules/PLL/Translation/Scanner.php
   ```
   👉 **Kết quả:** `No syntax errors detected` trên tất cả các tệp.

2. **Runtime Verification (Xác minh thực tế):**
   - Đã truy cập lại trang quản trị `vinacos.test/wp/wp-admin/admin.php?page=mlang_hd_pll`.
   - Menu phụ dưới mục **Ngôn ngữ** và tiêu đề `<h2>` đã chuyển sang **SPL Polylang**.
   - Không còn bắn lỗi Fatal Error khi tải trang hoặc lưu cài đặt.
