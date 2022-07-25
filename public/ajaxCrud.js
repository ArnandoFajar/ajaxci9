
$(document).ready(function () {
    $('#data_table').DataTable({
        ajax: 'user/findAll',
    });

});

function message(response) {
    if (response.success === true) {
        Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: response.messages,
            showConfirmButton: false,
            timer: 1000
        }).then(function () {
            $('#data_table').DataTable().ajax.reload(null, false).draw(false);
        })
    } else {
        Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: response.messages,
            showConfirmButton: false,
            timer: 1000
        })
    }
}

function addModal() {
    $("#addForm").trigger("reset");
    var validator = $("#addForm").validate();
    validator.resetForm();

    $("#tambahModal").modal('show');
    $("#id").val("");
    $("#name").val("");
    $("#phone").val("");
    $("#email").val("");
    $("#country").val("");
    $("#btn-submit").html("Add");
}

function editModal(id, data) {
    $("#editModal").modal('show');
    $("#id").val(id);
    $("#name").val(data["name"]);
    $("#phone").val(data["phone"]);
    $("#email").val(data["email"]);
    $("#country").val(data["country"]);
    $("#btn-submit").html("Update");
}

//hapus data
function remove(id) {
    Swal.fire({
        title: 'Are you sure of the deleting process?',
        text: "You cannot back after confirmation",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (result.value) {
            $.ajax({
                url: "user/remove",
                type: 'post',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function (response) {

                    if (response.success === true) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: response.messages,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                        })
                    } else {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: response.messages,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            });
        }
    })
}

//klik edit
function edit(id) {
    var validator = $("#editForm").validate();
    validator.resetForm();
    $("input").removeClass("error");

    $.ajax({
        url: "user/getOne",
        type: 'post',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        data: {
            id
        },
        dataType: 'json',
        success: async function (data) {

            console.log(data['name']);
            editModal(id, data);
        }
    });
}

//validasi Tambah Data
$("#addForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 5,
        },
        phone: {
            required: true,
        },
        email: {
            required: true,
        },
        country: {
            required: true,
            minlength: 5,
        },
    },
    messages: {
        name: {
            required: "name harus diisi",
            minlength: "name harus lebih dari 5 huruf",
        },
        phone: {
            required: "phone harus diisi",
        },
        email: {
            required: "email harus diisi",
        },
        country: {
            required: "country harus diisi",
            minlength: "country harus lebih dari 5 huruf",
        },
    }
});

//validasi edit data
$("#editForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 5,
        },
        phone: {
            required: true,
        },
        email: {
            required: true,
        },
        country: {
            required: true,
            minlength: 5,
        },
    },
    messages: {
        name: {
            required: "name harus diisi",
            minlength: "name harus lebih dari 5 huruf",
        },
        phone: {
            required: "phone harus diisi",
        },
        email: {
            required: "email harus diisi",
        },
        country: {
            required: "country harus diisi",
            minlength: "country harus lebih dari 5 huruf",
        },
    },
});

//ajax tambah data
$('#addForm').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    if ($('#addForm').valid()) {
        $.ajax({
            type: "POST",
            url: actionUrl,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#tambahModal').modal('hide');
                    message(response);
                } else {
                    message(response);
                }
            }
        });
    }
});

//ajax edit data
$('#editForm').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    console.log(actionUrl);
    if ($('#editForm').valid()) {
        $.ajax({
            type: "POST",
            url: actionUrl,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    $('#editModal').modal('hide');
                    message(response);
                } else {
                    message(response);
                }
            }
        })
    }
})
