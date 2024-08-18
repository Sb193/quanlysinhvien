<h2 class="h3 mb-4 text-gray-800">Đăng ký   học</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <h4 class="h4 mb-0 font-weight-bold text-primary">Danh sách lớp đăng ký</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã lớp</th>
                        <th>Tên lớp</th>
                        <th>Môn học</th>
                        <th>Số tín chỉ</th>
                        <th>Giảng viên</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $class): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($class['classID']); ?></td>
                            <td><?php echo htmlspecialchars($class['className']); ?></td>
                            <td><?php echo htmlspecialchars($class['subjectName']); ?></td>
                            <td><?php echo htmlspecialchars($class['credits']); ?></td>
                            <td><?php echo htmlspecialchars($class['name']); ?></td>
                            <td><?php echo htmlspecialchars($class['quatity']); ?></td>
                            <td class="<?php switch ($class['status']){ 
                                case 'pending':
                                    echo "text-warning";
                                    break;
                                case 'approved':
                                    echo "text-primary";
                                    break;
                                case 'rejected':
                                    echo "text-danger";
                                    break;
                                default:
                                    echo "text-success";
                                    break;
                            } ?>"><?php echo htmlspecialchars(ucfirst($class['status'])); ?></td>
                            <td><a href="#" class="btn btn-primary registerClass" data-id="<?php echo $class['classID']; ?>">Đăng ký</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/register-subject.js"></script>'
?>


