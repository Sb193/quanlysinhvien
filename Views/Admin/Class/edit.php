<h1 class="h3 mb-4 text-gray-800">Sửa Thông Tin Lớp Học</h1>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">

        <!-- Form để sửa thông tin lớp học -->
        <form id="updateClassForm">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Lớp Học</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Phần hiển thị thông tin lớp học -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="classID">Mã Lớp Học</label>
                                <input type="text" class="form-control" id="classID" name="classID" value="<?php echo $class['classID']?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="className">Tên Lớp Học</label>
                                <input type="text" class="form-control" id="className" name="className" value="<?php echo $class['className']?>">
                            </div>

                            <div class="form-group">
                                <label for="subjectID">Mã Môn Học</label>
                                <input type="text" class="form-control" id="subjectID" name="subjectID" value="<?php echo $class['subjectID']?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="teacherID">Mã Giảng Viên</label>
                                <input type="text" class="form-control" id="teacherID" name="teacherID" value="<?php echo $class['teacherID']?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="quatity">Số Lượng Học Sinh</label>
                                <input type="number" class="form-control" id="quatity" name="quatity" value="<?php echo $class['quatity']?>">
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng Thái</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="approved" <?php echo $class['status'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                                    <option value="rejected" <?php echo $class['status'] == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                                    <option value="pending" <?php echo $class['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="success" <?php echo $class['status'] == 'success' ? 'selected' : ''; ?>>Success</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="index.php?controller=class&action=index" class="btn btn-secondary">Hủy</a>
                </div>
            </div>
        </form>

    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/update-class.js"></script> ';
?>
