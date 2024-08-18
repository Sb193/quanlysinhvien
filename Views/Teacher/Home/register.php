<h2 class="h3 mb-4 text-gray-800">Đăng ký lớp học để dạy</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h4 mb-0 font-weight-bold text-primary">Thông tin đăng ký lớp học</h4>
    </div>
    <div class="card-body">
        <form method="POST" name="registerClassForm" id="registerClassForm">
            <div class="form-group">
                <label for="subjectID">Chọn môn học</label>
                <select class="form-control" id="subjectID" name="subjectID" required>
                    <option value="">-Chọn môn học-</option>
                    <?php foreach ($subjects as $subject): ?>
                        <option value="<?php echo htmlspecialchars($subject['subjectID']); ?>">
                            <?php echo htmlspecialchars($subject['subjectName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="className">Tên lớp học</label>
                <input type="text" class="form-control" id="className" name="className" placeholder="Nhập tên lớp học" required>
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng sinh viên</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng sinh viên" required>
            </div>


            <button type="submit" class="btn btn-primary">Đăng ký lớp học</button>
            <a href="index.php?controller=class&action=index" class="btn btn-secondary">Hủy bỏ</a>
        </form>
    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/register-class.js"></script>';
?>
