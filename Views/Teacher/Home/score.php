<h2 class="h3 mb-4 text-gray-800">Quản lý điểm</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h4 mb-0 font-weight-bold text-primary">Danh sách học sinh và điểm số</h4>
    </div>
    <div class="card-body">
        <form action="index.php?controller=score&action=save" method="POST">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã sinh viên</th>
                            <th>Tên</th>
                            <th>Môn học</th>
                            <th>Số tín chỉ</th>
                            <th>Điểm chuyên cần</th>
                            <th>Điểm thi</th>
                            <th>Điểm tổng kết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $student): ?>
                            <tr>
                            <td><?php echo $student['studentID'] ?></td>
                            <td><?php echo $student['name'] ?></td>
                            <td><?php echo $student['subjectName'] ?></td>
                            <td><?php echo $student['credits'] ?></td>
                            <td>
                                <input type="number" name="attendance" class="form-control attendance-score" data-score-id="<?php echo $student['scoreID'] ?>" min="0" max="10" step="0.1" value="<?php echo $student['attendanceScore'] ?>">
                            </td>
                            <td>
                                <input type="number" name="exam" class="form-control exam-score" data-score-id="<?php echo $student['scoreID'] ?>" min="0" max="10" step="0.1" value="<?php echo $student['examScore'] ?>">
                            </td>
                            <td>
                                <input type="number" name="final" class="form-control final-score" data-score-id="<?php echo $student['scoreID'] ?>" min="0" max="10" step="0.1" value="<?php echo $student['finalScore'] ?>" readonly>
                            </td>
                            
                            <td>
                                <button class="btn btn-primary btn-save" data-score-id="<?php echo $student['scoreID'] ?>">Lưu</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Lưu điểm</button>
        </form>
    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/save-score.js"></script>'
?>