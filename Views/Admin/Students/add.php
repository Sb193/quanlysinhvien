<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Thêm mới sinh viên</h1>

<!-- Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thông tin chi tiết</h6>
    </div>
    <div class="card-body">
        <form action="" method="POST" name="addStudentForm" id="addStudentForm">
            <div class="form-group">
                <label for="name">Mã sinh viên</label>
                <input type="text" class="form-control" id="studentID" name="studentID" required>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="name">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="birth">Ngày sinh</label>
                    <input type="date" class="form-control" id="birth" name="birth" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="cccd">CCCD</label>
                <input type="text" class="form-control" id="cccd" name="cccd" required>
            </div>
            
            <div class="form-group">
                <label for="placeOfbirth">Nơi sinh</label>
                <input type="text" class="form-control" id="placeOfBirth" name="placeOfbirth" required>
            </div>
            <div class="form-group">
                <label for="normalAddress">Địa chỉ thường trú</label>
                <input type="text" class="form-control" id="normalAddress" name="normalAddress" required>
            </div>
            <div class="form-group">
                <label for="currentAddress">Địa chỉ hiện tại</label>
                <input type="text" class="form-control" id="currentAddress" name="currentAddress" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Số điện thoại</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
            <div class="form-group">
                <label for="course">Khóa</label>
                <input type="number" class="form-control" id="course" name="course" required>
            </div>
            <button id="addStudentButton" type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>


<?php
    $script = '<script src="assets/js/demo/add-student.js"></script>'
?>