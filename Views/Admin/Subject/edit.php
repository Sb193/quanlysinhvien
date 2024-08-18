<h1 class="h3 mb-4 text-gray-800">Sửa Thông Tin Môn Học</h1>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">

        <!-- Form để sửa thông tin môn học -->
        <form id="updateSubjectForm" method="POST" action="index.php?controller=subject&action=update">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông Tin Môn Học</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Phần hiển thị thông tin môn học -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subjectID">Mã Môn Học</label>
                                <input type="text" class="form-control" id="subjectID" name="subjectID" value="<?php echo $subject['subjectID']; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="subjectName">Tên Môn Học</label>
                                <input type="text" class="form-control" id="subjectName" name="subjectName" value="<?php echo $subject['subjectName']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="credits">Số Tín Chỉ</label>
                                <input type="number" class="form-control" id="credits" name="credits" value="<?php echo $subject['credits']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="index.php?controller=subject&action=index" class="btn btn-secondary">Hủy</a>
                </div>
            </div>
        </form>

    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/update-subject.js"></script>';
?>
