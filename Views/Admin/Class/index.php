<h2 class="h3 mb-4 text-gray-800">Quản lý lớp học</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h4 class="h4 mb-0 font-weight-bold text-primary">Danh sách lớp học</h4>
            <a href="index.php?controller=class&action=add" class="btn btn-primary">Thêm lớp học</a>
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
                        <th>Hành động</th>
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
                            <td><?php echo htmlspecialchars(ucfirst($class['status'])); ?></td>
                            <td>
                                <a href="index.php?controller=class&action=edit&id=<?php echo $class['classID']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="#" class="btn btn-danger btn-sm deleteClass" data-id="<?php echo $class['classID']; ?>">Xóa</a>
                                <?php if ($class['status'] == 'pending'): ?>
                                    <a href="index.php?controller=class&action=approved&id=<?php echo $class['classID']; ?>" class="btn btn-success btn-sm approveClass">Duyệt</a>
                                    <a href="index.php?controller=class&action=rejected&id=<?php echo $class['classID']; ?>" class="btn btn-secondary btn-sm rejectClass">Từ chối</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Phân trang -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?controller=class&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<?php 
    $script = '<script src="assets/js/demo/duyet.js"></script> <script src="assets/js/demo/delete-class.js"></script>'
?>