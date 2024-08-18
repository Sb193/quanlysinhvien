import random

# Hàm tạo mã sinh viên ngẫu nhiên với 16 ký tự
def generate_student_id(index):
    return f"DTC{index:013d}"

# Hàm tạo tên ngẫu nhiên
def generate_name():
    first_names = ["Nguyễn", "Trần", "Lê", "Phạm", "Hoàng", "Vũ", "Đặng", "Bùi", "Đỗ", "Hồ"]
    middle_names = ["Văn", "Thị", "Hữu", "Minh", "Quốc", "Gia", "Ngọc", "Thanh", "Anh", "Bảo"]
    last_names = ["An", "Bình", "Châu", "Duy", "Hà", "Khoa", "Linh", "Mai", "Nhân", "Phúc"]
    return f"{random.choice(first_names)} {random.choice(middle_names)} {random.choice(last_names)}"

# Tạo dữ liệu mẫu
for i in range(1, 101):
    student_id = generate_student_id(i)
    name = generate_name()
    if i>17:
        print(f"INSERT INTO Person (cccd, name, birth, placeOfbirth, normalAddress, currentAddress, avatar, phoneNumber) VALUES ('{random.randint(100000000000, 999999999999)}', '{name}', '2000-01-01', 'Hà Nội', '123 Đường A', '456 Đường B', 'assets\\img\\avatar\\default.png', '0123456789');")
    print(f"INSERT INTO Account (username, password, type) VALUES ('{student_id}', '123456', 1);")
    print(f"INSERT INTO Student (studentID, username, course, personID) VALUES ('{student_id}', '{student_id}', 1, {i+3});")
