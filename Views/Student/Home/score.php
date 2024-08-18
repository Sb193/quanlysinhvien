<h2 class="h3 mb-4 text-gray-800">Xem điểm cá nhân</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="h4 mb-0 font-weight-bold text-primary">Điểm của bạn</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã môn học</th>
                        <th>Tên môn học</th>
                        <th>Số tín chỉ</th>
                        <th>Điểm chuyên cần</th>
                        <th>Điểm thi</th>
                        <th>Điểm tổng kết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $score): ?>
                        <tr>
                            <td><?php echo $score['subjectID'] ?></td>
                            <td><?php echo $score['subjectName'] ?></td>
                            <td><?php echo $score['credits'] ?></td>
                            <td><?php echo $score['attendanceScore'] ?></td>
                            <td><?php echo $score['examScore'] ?></td>
                            <td><?php echo $score['finalScore'] ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
