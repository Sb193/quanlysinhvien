<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Thêm mới môn học</h1>

<!-- Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thông Tin Chi Tiết</h6>
    </div>
    <div class="card-body">
        <form action="index.php?controller=subject&action=add" method="POST" name="addSubjectForm" id="addSubjectForm">
            <div class="form-group">
                <label for="subjectName">Tên Môn Học</label>
                <input type="text" class="form-control" id="subjectName" name="subjectName" required>
            </div>
            <div class="form-group">
                <label for="credits">Số Tín Chỉ</label>
                <input type="number" class="form-control" id="credits" name="credits" required>
            </div>
            <button id="addSubjectButton" type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>

<?php
    $script = '<script src="assets/js/demo/add-subject.js"></script>';
?>
