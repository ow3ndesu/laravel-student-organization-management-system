@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            {{ __("Students") }}
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addStudentModal">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Add Student Modal -->
                    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="addStudentForm" action="javascript:void(0);" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addStudentModal">Add Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __("Name")
                                            }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus />

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __("Email
                                            Address") }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" />

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{
                                            __("Password") }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password" />

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{
                                            __("Confirm Password") }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="type" class="col-md-4 col-form-label text-md-end">{{ __("Type")
                                            }}</label>

                                        <div class="col-md-6">
                                            <select name="type" id="type" class="form-control" required>
                                                <option value="Student">Student</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="addStudentSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Student Modal -->
                    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="editStudentForm" action="javascript:void(0);" method="PUT">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mt-3 mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __("Name")
                                                }}</label>
    
                                            <div class="col-md-6">
                                                <input id="new_name" type="text"
                                                    class="form-control @error('new_name') is-invalid @enderror" name="new_name"
                                                    value="{{ old('new_name') }}" required autocomplete="new_name" autofocus />
    
                                                @error('new_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
    
                                        <div class="row mb-3">
                                            <label for="new_email" class="col-md-4 col-form-label text-md-end">{{ __("Email
                                                Address") }}</label>
    
                                            <div class="col-md-6">
                                                <input id="new_email" type="email"
                                                    class="form-control @error('new_email') is-invalid @enderror" name="new_email"
                                                    value="{{ old('new_email') }}" required autocomplete="new_email" />
    
                                                @error('new_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="editStudentSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"  class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentsTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Remove Vue Error -->
</div>
</div>

<script>
    $(document).ready(function () {
        function getStudents() {
            var students;

            $.ajax({
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.students')}}",
                success: function (data) {
                    $('#studentsTableBody').empty();

                    data.forEach(element => {
                        $('#studentsTableBody').append(`
                            <tr>
                                <td>`+ element.name + `</td>
                                <td>`+ element.email + `</td>
                                <td  class="text-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" value="` +
                            element.id +
                            `" name="editStudent" class="btn btn-primary" id="editStudent" data-bs-toggle="modal" data-bs-target="#editStudentModal">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button type="button" value="` +
                            element.id +
                            `" name="deleteStudent" class="btn btn-danger between" id="deleteStudent">
                                                 <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                </td>
                             </tr>
                        `);
                    });
                },
            });
        };
        getStudents();

        $(document).unbind('submit').on('submit', '#addStudentForm', function () {
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var confirmation = $('#password-confirm').val();
            var type = $('#type').val();

            if (password === confirmation) {
                var formData = new FormData();
                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                formData.append('name', name);
                formData.append('email', email);
                formData.append('password', password);
                formData.append('type', type);

                $.ajax({
                    url: "{{ route('student.store') }}",
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        if (data == 1) {
                            $('#addStudentModal').modal('hide');
                            Swal.fire(
                                'Successed!',
                                'Student Account Added!',
                                'success'
                            )

                            $('#addStudentForm').trigger('reset');
                            $('#studentsTableBody').empty();
                            getStudents();
                        }
                    }
                })

            } else {
                $('#addStudentModal').modal('hide');
                Swal.fire(
                    'Failed!',
                    'Password does not match!',
                    'error'
                )

                $('#addStudentForm').trigger('reset');
            }
        });
        
        $(document).on('click', "button[name='editStudent']", function () {
            var id = $(this).val();
            var route = "{{ route('student.edit', ':id')}}";
            route = route.replace(":id", id);

            $.ajax({
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    $('#id').val(data[0]['id']);
                    $('#new_name').val(data[0]['name']);
                    $('#new_email').val(data[0]['email']);
                }
            }),

                $(document).unbind('submit').on("submit", "#editStudentForm", function () {
                    let id = $('#id').val();
                    let name = $('#new_name').val();
                    let email = $('#new_email').val();

                    let route = "{{ route('student.update', ':id')}}";
                    route = route.replace(':id', id);

                    let formData = new FormData();
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("_method", 'PUT');
                    formData.append('name', name);
                    formData.append('place', email);

                    $.ajax({
                        url: route,
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            if (data == 1) {
                                $('#editStudentModal').modal('hide');
                                Swal.fire(
                                    'Successed!',
                                    'Student Updated!',
                                    'success'
                                )

                                $('#editStudentForm').trigger('reset');
                                $('#studentTableBody').empty();
                                getStudents();
                            } else {
                                $('#editStudentModal').modal('hide');
                                Swal.fire(
                                    'Failed!',
                                    'Nothing Changes!',
                                    'error'
                                )

                                $('#editStudentForm').trigger('reset');
                            }
                        }
                    })
                });
        });

        $(document).on('click', "button[name='deleteStudent']", function () {
            var id = $(this).val();
            var route = "{{ route('student.destroy', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formData,
                        success: function (data) {
                            if (data >= 1) {
                                Swal.fire(
                                    'Successed!',
                                    'Student Deleted!',
                                    'success'
                                )
                                $('#studentsTableBody').empty();
                                getStudents();
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Something went wrong!',
                                    'error'
                                )
                            }
                        },
                    });
                }
            })
        });
    });
</script>
@endsection