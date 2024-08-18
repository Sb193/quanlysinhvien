<h2 class="h3 mb-4 text-gray-800">Quản lý đăng ký lớp học</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h4 class="h4 mb-0 font-weight-bold text-primary">Danh sách đăng ký</h4>
            <a href="index.php?controller=class&action=registerclass" class="btn btn-primary">Đăng ký lớp</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã lớp học</th>
                        <th>Tên lớp học</th>
                        <th>Môn học</th>
                        <th>Giảng viên</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $class): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($class['classID']); ?></td>
                            <td><?php echo htmlspecialchars($class['className']); ?></td>
                            <td><?php echo htmlspecialchars($class['subjectName']); ?></td>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


