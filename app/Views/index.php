<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeIgniter 4 Crud Full Ajax Jquery</title>
    <!-- <link rel="stylesheet" href="<?= base_url("assets/dist/css/bootstrap.min.css") ?>"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="shortcut icon" href="<?= base_url("favicon.ico") ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>

    <style>
        .error {
            color: red;
        }
    </style>


    <div class="container mt-3">
        <h3>CodeIgniter 4 Crud Full Ajax Jquery - Muhamad Odhie Prasetio</h3>
        <h5>- jquery 3.5.1 <br>
            - jquery validate <br>
            - SweetAlert 2 <br>
            - Bootstrap 5 <br>
            - DataTables
        </h5>
        <button type="button" class="btn btn-primary float-end my-2" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="addModal()">Add</button>
        <table class="table" id="data_table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">country</th>
                    <th scope="col">Country </th>
                    <th scope="col">Action </th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?= base_url("save") ?>" id="modalForm">
                    <input type="hidden" id="id" name="id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name: </label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="col-form-label">Phone : </label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email : </label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="col-form-label">country : </label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        $(document).ready(function() {
            $('#data_table').DataTable({
                ajax: '<?= base_url('findAll') ?>',

            });

        });

        function message(response) {
            if (response.success === true) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: response.messages,
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
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


        var modal = bootstrap.Modal.getOrCreateInstance($("#exampleModal"));

        function addModal() {
            $("#id").val("");
            $("#name").val("");
            $("#phone").val("");
            $("#email").val("");
            $("#country").val("");
            $("#btn-submit").html("Add");
        }

        async function editModal(id, data) {
            $("#id").val(id);
            $("#name").val(data["name"]);
            $("#phone").val(data["phone"]);
            $("#email").val(data["email"]);
            $("#country").val(data["country"]);
            $("#btn-submit").html("Update");
            modal.show();
        }

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
                        url: "<?= base_url("remove") ?>",
                        type: 'post',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {

                            if (response.success === true) {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: response.messages,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
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

        async function edit(id) {
            var validator = $("#modalForm").validate();
            validator.resetForm();
            $("input").removeClass("error");

            $.ajax({
                url: "<?= base_url("getOne") ?>",
                type: 'post',
                data: {
                    id
                },
                dataType: 'json',
                success: async function(data) {

                    console.log(data['name']);
                    editModal(id, data);
                }
            });
        }


        $("#modalForm").validate({
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

        $("#modalForm").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');

            if ($("form").valid()) {



                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            modal.hide();
                            message(response);
                        } else {
                            message(response);
                        }


                    }
                })
            };

        });
    </script>

</body>

</html>