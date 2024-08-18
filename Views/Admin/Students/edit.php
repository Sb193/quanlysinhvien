<h1 class="h3 mb-4 text-gray-800">Sửa Thông Tin Sinh Viên</h1>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">

        <!-- Form để sửa thông tin sinh viên -->
        <form id="updateStudentForm">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Sinh Viên</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Phần hiển thị avatar -->
                        <div class="col-md-4 text-center">
                            <img src="<?php echo $student['person']['avatar'] ?: 'assets/img/default-avatar.png'; ?>" alt="Avatar Sinh Viên" class="img-fluid rounded-circle mb-4" style="width: 150px; height: 150px;">
                            <p>Ảnh đại diện</p>
                        </div>

                        <!-- Phần hiển thị thông tin -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="studentID">Mã Sinh Viên</label>
                                <input type="text" class="form-control" id="studentID" name="studentID" value="<?php echo $student['studentID']?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Họ và Tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['person']['name']?>">
                            </div>
                            <div class="form-group">
                                <label for="birth">Ngày Sinh</label>
                                <input type="date" class="form-control" id="birth" name="birth" value="<?php echo $student['person']['birth']?>">
                            </div>
                            <div class="form-group">
                                <label for="cccd">CCCD</label>
                                <input type="text" class="form-control" id="cccd" name="cccd" value="<?php echo $student['person']['cccd']?>">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $student['person']['phoneNumber']?>">
                            </div>
                            <div class="form-group">
                                <label for="placeOfBirth">Nơi Sinh</label>
                                <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" value="<?php echo $student['person']['placeOfbirth']?>">
                            </div>
                            <div class="form-group">
                                <label for="normalAddress">Địa Chỉ Thường Trú</label>
                                <input type="text" class="form-control" id="normalAddress" name="normalAddress" value="<?php echo $student['person']['normalAddress']?>">
                            </div>
                            <div class="form-group">
                                <label for="currentAddress">Địa Chỉ Hiện Tại</label>
                                <input type="text" class="form-control" id="currentAddress" name="currentAddress" value="<?php echo $student['person']['currentAddress']?>">
                            </div>
                            <div class="form-group">
                                <label for="course">Khóa</label>
                                <input type="text" class="form-control" id="course" name="course" value="<?php echo $student['course']?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="index.php?controller=student&action=index" class="btn btn-secondary">Hủy</a>
                </div>
            </div>
        </form>

    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/update-student.js"></script> ';
?>
