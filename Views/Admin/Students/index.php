<h2 class="h3 mb-4 text-gray-800">Quản lý sinh viên</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h4 class="h4 mb-0 font-weight-bold text-primary">Danh sách sinh viên</h4>
            <a href="index.php?controller=student&action=add" class="btn btn-primary">Thêm sinh viên</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã sinh viên</th>
                        <th>Tên</th>
                        <th>Ngày sinh</th>
                        <th>CCCD</th>
                        <th>Số điện thoại</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $student): ?>
                        <tr>
                            <td><?php echo $student['studentID'] ?></td>
                            <td><?php echo $student['name'] ?></td>
                            <td><?php echo $student['birth'] ?></td>
                            <td><?php echo $student['cccd'] ?></td>
                            <td><?php echo $student['phoneNumber'] ?></td>
                            <td>
                                <a href="index.php?controller=student&action=edit&id=<?php echo $student['studentID'] ?>" class="btn btn-warning btn-sm">Chi tiết</a>
                                <a href="index.php?controller=student&action=delete&id=<?php echo $student['studentID'] ?>" class="btn btn-danger btn-sm" >Xóa</>
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
                <a class="page-link" href="index.php?controller=student&action=index&page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

