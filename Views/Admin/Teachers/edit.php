<h1 class="h3 mb-4 text-gray-800">Sửa Thông Tin Giáo Viên</h1>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">

        <!-- Form để sửa thông tin giáo viên -->
        <form id="updateTeacherForm">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Giảng Viên</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Phần hiển thị avatar -->
                        <div class="col-md-4 text-center">
                            <img src="<?php echo $teacher['person']['avatar'] ?: 'assets/img/default-avatar.png'; ?>" alt="Avatar Giáo Viên" class="img-fluid rounded-circle mb-4" style="width: 150px; height: 150px;">
                            <p>Ảnh đại diện</p>
                        </div>

                        <!-- Phần hiển thị thông tin -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="teacherID">Mã Giáo Viên</label>
                                <input type="text" class="form-control" id="teacherID" name="teacherID" value="<?php echo $teacher['teacherID']?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Họ và Tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $teacher['person']['name']?>">
                            </div>
                            <div class="form-group">
                                <label for="birth">Ngày Sinh</label>
                                <input type="date" class="form-control" id="birth" name="birth" value="<?php echo $teacher['person']['birth']?>">
                            </div>
                            <div class="form-group">
                                <label for="cccd">CCCD</label>
                                <input type="text" class="form-control" id="cccd" name="cccd" value="<?php echo $teacher['person']['cccd']?>">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $teacher['person']['phoneNumber']?>">
                            </div>
                            <div class="form-group">
                                <label for="placeOfBirth">Nơi Sinh</label>
                                <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" value="<?php echo $teacher['person']['placeOfbirth']?>">
                            </div>
                            <div class="form-group">
                                <label for="normalAddress">Địa Chỉ Thường Trú</label>
                                <input type="text" class="form-control" id="normalAddress" name="normalAddress" value="<?php echo $teacher['person']['normalAddress']?>">
                            </div>
                            <div class="form-group">
                                <label for="currentAddress">Địa Chỉ Hiện Tại</label>
                                <input type="text" class="form-control" id="currentAddress" name="currentAddress" value="<?php echo $teacher['person']['currentAddress']?>">
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="index.php?controller=teacher&action=index" class="btn btn-secondary">Hủy</a>
                </div>
            </div>
        </form>

    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/update-teacher.js"></script>';
?>
