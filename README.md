# Student Manager Plugin

Plugin WordPress quản lý sinh viên với Custom Post Type, Meta Boxes và Shortcode.

---
# Họ và tên : Nguyễn Văn Danh
# MSV : 23810310136
# lớp : D18CNPM2
## Cấu trúc thư mục

```
student-manager/
├── student-manager.php       # File chính, khai báo plugin header
├── includes/
│   ├── cpt.php               # Đăng ký Custom Post Type
│   ├── meta-box.php          # Meta Box nhập liệu thông tin sinh viên
│   └── shortcode.php         # Shortcode [danh_sach_sinh_vien]
├── assets/
│   └── style.css             # CSS cho bảng hiển thị frontend
└── README.md
```

---

## Các bước cài đặt và sử dụng

### Bước 1 — Cài đặt plugin

1. Sao chép thư mục `student-manager` vào `wp-content/plugins/`.
2. Vào **WordPress Admin → Plugins → Installed Plugins**.
3. Tìm **Student Manager** và nhấn **Activate**.

> Sau khi kích hoạt, vào **Settings → Permalinks** và nhấn **Save Changes** để WordPress nhận diện Custom Post Type mới.

---

### Bước 2 — Thêm sinh viên

1. Trong menu Admin, chọn **Sinh viên → Thêm mới**.
2. Nhập **Họ tên** vào ô tiêu đề (Title).
3. Nhập **Tiểu sử / Ghi chú** vào ô Editor (nếu có).
4. Kéo xuống phần **Thông tin sinh viên**, điền:
   - **MSSV** (Mã số sinh viên)
   - **Lớp / Chuyên ngành** (chọn từ dropdown: CNTT, Kinh tế, Marketing)
   - **Ngày sinh** (chọn từ date picker)
5. Nhấn **Publish** để lưu.
   
<img width="1919" height="801" alt="image" src="https://github.com/user-attachments/assets/4b512b89-0615-4d15-89eb-2f6b7eec766f" />


---

### Bước 3 — Hiển thị danh sách sinh viên

1. Vào **Pages → Add New**, tạo một trang mới (ví dụ: "Danh sách sinh viên").
2. Trong nội dung trang, chèn shortcode:

```
[danh_sach_sinh_vien]
```

3. Nhấn **Publish** và xem trang ngoài frontend.

---

## Kết quả hiển thị
<img width="1908" height="821" alt="image" src="https://github.com/user-attachments/assets/356fc2ee-98e0-4deb-89f9-26782ec993d0" />

---
<img width="1916" height="784" alt="image" src="https://github.com/user-attachments/assets/ebf0c4ea-1acf-422f-8258-f007cc22c165" />


---

## Tính năng bảo mật

- **Nonce** (`wp_nonce_field` / `wp_verify_nonce`): Xác thực nguồn gốc form khi lưu dữ liệu.
- **Sanitize**: Tất cả dữ liệu đầu vào được làm sạch bằng `sanitize_text_field()` trước khi lưu vào database.
- **Escape output**: Dữ liệu hiển thị ra HTML đều được escape bằng `esc_html()` / `esc_attr()`.
- **Capability check**: Kiểm tra quyền `edit_post` trước khi lưu.

---

## Yêu cầu hệ thống

- WordPress 5.8+
- PHP 7.4+
