<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
        integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>
<style>
    body {
        background-color: aliceblue;
    }

    .container {
        /* background-color: cadetblue; */
        border-radius: 2%;
        padding: 2%;
        max-width: 1450px;
        border: 5px solid wheat;
    }
    .button {
        margin-left: 7%;
    }
</style>
<body>
        <div class="button mt-5">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a type="button" href="/" class="btn btn-primary">Home</a>
                <a type="button" href="/adduser" class="btn btn-primary">Add User</a>
                <a type="button" href="/listing" class="btn btn-primary">Listing</a>
              </div>
        </div>
    <div class="container mt-3">
        <form onsubmit="return false" method="POST" enctype="multipart/form-data" id="formdata">
            <input type="hidden" id="id" name="id" value="">
            <div>
                <label for="" class="form-label"><b>Firstname:</b></label>
                <input id="firstname" name="firstname" class="form-control" type="text" placeholder="Firstname">
            </div>
            <div>
                <label for="" class="form-label"><b>Lastname:</b></label>
                <input id="lastname" name="lastname" class="form-control" type="text" placeholder="Lastname">
            </div>
            <div>
                <label for="" class="form-label"><b>Email:</b></label>
                <input id="email" name="email" class="form-control" type="email" placeholder="Email">
            </div>
            <div>
                <label for="" class="form-label"><b>Password:</b></label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="mt-2 mb-2">
                <label for="" class="form-label"><b>Gender:</b></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <label for="formFile" class="form-label"><b>Image Upload:</b></label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>
                <div id="img" name="img">

                </div>
            </div>
            <div>
                <label for="" class="form-label"><b>Role:</b></label>
                <select class="form-select" id="role" name="role">
                    <option selected disabled>Select...</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="employee">Employee</option>
                </select>
            </div>
            <div>
                <div id="managerDropdown" style="display: none;">
                <label for="" class="form-label"><b>Role Types:</b></label>
                <select class="form-select" id="role_type" name="role_type">
                    <option selected disabled>Select...</option>
                    
                </select>
                </div>
            </div>
            <div>
                <label for="" class="form-label"><b>Status:</b></label>
                <select class="form-select" id="status" name="status">
                    <option selected disabled>Select...</option>
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-info mt-3 mb-3">Submit</button>
        </form>
        <table class="table table-dark table-hover" id="tabledata">
            <thead>
                <tr>
                    <th>SerialNo</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>Role</th>
                    <th>Role Types</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {

            $("#formdata").submit(function() {
                $.ajax({
                    type: 'POST',
                    url: '/add',
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: new FormData(this),
                    success: function(data) {
                        if (data.status == "1"){
                            toastr.success(data.message, { timeOut: 1000 });
                        }
                        $('#formdata').trigger("reset");
                        $('#tabledata').DataTable().ajax.reload();
                        $("#id").val("");
                        $("#img").html("");
                    }
                });
            });

            $('#tabledata').DataTable({
                destroy: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax: {
                    url: '/list'
                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: "firstname"
                    },
                    {
                        data: "lastname"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "password"
                    },
                    {
                        data: "gender"
                    },
                    {
                        data: "image",
                        "orderable": false
                    },
                    {
                        data: "role"
                    },
                    {
                        data: "role_type"
                    },
                    {
                        data: "status",
                        "orderable": false
                    },
                    {
                        data: "action",
                        "orderable": false
                    }
                ]
            });

            $('#role').change(function() {
                var selectedRole = $(this).val();
                if (selectedRole === 'admin') {
                    $('#managerDropdown').hide();
                } else {
                    $('#managerDropdown').show();
                }  
                $.ajax({
                    url: '/getmanageroptions',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var managers = response.managers;
                        var employees = response.employees;

                        if (selectedRole === 'manager') {
                        $('#role_type').empty().append('<option value="" selected disabled>Select...</option>');
                        $.each(managers, function(index, manager) {
                            $('#role_type').append('<option value="' + manager.id + '">' + manager.manager + '</option>');
                        });
                    } else if (selectedRole === 'employee') {
                            $('#role_type').empty().append('<option value="" selected disabled>Select...</option>');
                        $.each(employees, function(index, employee) {
                            $('#role_type').append('<option value="' + employee.id + '">' + employee.employee + '</option>');
                        });
                    }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching role types:', error);
                    }
                });
                // var options = {
                //     manager: ["Purchase Manager", "Sales Manager", "Support Manager", "Senior Manager", "General Manager"],
                //     employee: ["Cloud Engineer", "Security Engineer", "Software Engineer", "DevOps", "Hardware Engineer"]
                // };

                // $('#role_type').empty().append('<option value="" selected disabled>Select...</option>');

                // if (selectedRole === 'manager') {
                //     $.each(options.manager, function(index, manager) {
                //         $('#role_type').append('<option value="' + manager + '">' + manager + '</option>');
                //     });
                // } else if (selectedRole === 'employee') {
                //     $.each(options.employee, function(index, employee) {
                //         $('#role_type').append('<option value="' + employee + '">' + employee + '</option>');
                //     });
                // }
            });

            $(document).on("click", "#statusCheckbox",function() {
            var isChecked = $(this).prop('checked');
            $.ajax({
                url: '/update-admin-status',
                type: 'POST',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data: { status: isChecked ? 1 : 0 },
                success: function(response) {
                    console.log(response);
                    if (response.status == "1"){
                            toastr.success(response.message, { timeOut: 1000 });
                        }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
                });
            });

            $(document).on("click","#edit",function(){
                var id = $(this).data("id");
                $.ajax({
                    type:'get',
                    url:'/edit',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data: {id:id},
                success: function(response) {
                    console.log(response);
                    $("#id").val(response.id);
                    $("#firstname").val(response.firstname);
                    $("#lastname").val(response.lastname);
                    $("#email").val(response.email);
                    $("#password").val(response.password);
                    $('input[type="radio"]').filter('[value=' + response.gender + ']').prop("checked", true);
                    var image = "<img src='<?php echo e(asset('image/')); ?>/" + response.image + "' width='100px' height='100px'>";
                    $("#img").html(image);
                    $("#role").val(response.role);
                    if (response.role === "manager" || response.role === "employee") {
                        $('#managerDropdown').show();
                    } else {
                        $('#managerDropdown').hide();
                    }
                    $("#role").trigger("change");
                    $("#role_type").val(response.role_type);
                    $("#status").val(response.status);
                }
                });
            });

            $(document).on("click","#delete",function(){
                var id = $(this).data('id');
                $.ajax({
                    type:"post",
                    url:"/delete",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data: { id:id},
                success: function(response) {
                    if (response.status == "1"){
                            toastr.success(response.message, { timeOut: 1000 });
                        }
                console.log(response);
                $('#formdata').trigger("reset");
                $('#tabledata').DataTable().ajax.reload();
                $("#img").html("");
                }
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\wamp64\www\Admin\resources\views//adduser.blade.php ENDPATH**/ ?>