<h2 class="h3 mb-4 text-gray-800">Quản lý lớp học</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <h4 class="h4 mb-0 font-weight-bold text-primary">Danh sách lớp quản lý</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Ngày sinh</th>
                        <th>Mã lớp</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['studentID']); ?></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['birth']); ?></td>
                            <td><?php echo htmlspecialchars($student['classID']); ?></td>
                            <td><a class="btn btn-primary" href="index.php?controller=score&classlistID=<?php echo $student['classListID']?>">Điếm số</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


