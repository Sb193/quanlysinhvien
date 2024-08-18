$(document).ready(function() {
    $('#update-person-form').on('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của nút
        // Thu thập dữ liệu từ form
        var formData = {
            name: $('#name').val(),
            birth: $('#birth').val(),
            cccd: $('#cccd').val(),
            phoneNumber: $('#phoneNumber').val(),
            placeOfBirth: $('#placeOfBirth').val(),
            normalAddress: $('#normalAddress').val(),
            currentAddress: $('#currentAddress').val()
        };

        $.ajax({
            url: 'index.php?controller=person&action=update',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Xử lý phản hồi từ server
                var data = JSON.parse(response);
                if (data.success) {
                    Swal.fire({
                        title: 'Thành công!',
                        text: 'Thông tin đã được cập nhật thành công.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn-success'
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn-danger'
                        }
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Có lỗi xảy ra khi gửi dữ liệu.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn-danger'
                    }
                });
            }
        });
    });
});
