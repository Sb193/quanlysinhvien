<h2 class="h3 mb-4 text-gray-800">Quản lý môn học</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h4 class="h4 mb-0 font-weight-bold text-primary">Danh sách môn học</h4>
            <a href="index.php?controller=subject&action=add" class="btn btn-primary">Thêm môn học</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã môn học</th>
                        <th>Tên môn học</th>
                        <th>Số tín chỉ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $subject): ?>
                        <tr>
                            <td><?php echo $subject['subjectID']; ?></td>
                            <td><?php echo $subject['subjectName']; ?></td>
                            <td><?php echo $subject['credits']; ?></td>
                            <td>
                                <a href="index.php?controller=subject&action=edit&id=<?php echo $subject['subjectID']; ?>" class="btn btn-warning btn-sm">Chi tiết</a>
                                <a href="index.php?controller=subject&action=delete&id=<?php echo $subject['subjectID']; ?>" class="btn btn-danger btn-sm">Xóa</a>
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
                <a class="page-link" href="index.php?controller=subject&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<?php
    $script = '<script src="assets/js/demo/delete-subject.js"></script>';
?>
