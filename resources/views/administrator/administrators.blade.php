@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            {{ __("Administrators") }}
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addAdministratorModal">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Add Administrator Modal -->
                    <div class="modal fade" id="addAdministratorModal" tabindex="-1"
                        aria-labelledby="addAdministratorModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="addAdministratorForm" action="javascript:void(0);" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addAdministratorModal">Add Administrator</h5>
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
                                                <option value="Administrator">Administrator</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="addAdministratorSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Administrator Modal -->
                    <div class="modal fade" id="editAdministratorModal" tabindex="-1"
                        aria-labelledby="editAdministratorModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="editAdministratorForm" action="javascript:void(0);" method="PUT">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAdministratorModalLabel">Edit Administrator</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mt-3 mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __("Name")
                                                }}</label>

                                            <div class="col-md-6">
                                                <input id="new_name" type="text"
                                                    class="form-control @error('new_name') is-invalid @enderror"
                                                    name="new_name" value="{{ old('new_name') }}" required
                                                    autocomplete="new_name" autofocus />

                                                @error('new_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="new_email" class="col-md-4 col-form-label text-md-end">{{
                                                __("Email
                                                Address") }}</label>

                                            <div class="col-md-6">
                                                <input id="new_email" type="email"
                                                    class="form-control @error('new_email') is-invalid @enderror"
                                                    name="new_email" value="{{ old('new_email') }}" required
                                                    autocomplete="new_email" />

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
                                            id="editAdministratorSubmitButton">Submit</button>
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
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="AdministratorsTableBody">
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
        function getAdministrators() {
            var Administrators;

            $.ajax({
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.administrators')}}",
                success: function (data) {
                    $('#AdministratorsTableBody').empty();

                    var button = ``;

                    data.forEach(element => {
                        if (data.length != 1) {
                            button = `<button type="button" value="` +
                                element.id +
                                `" name="deleteAdministrator" class="btn btn-danger between" id="deleteAdministrator">
                                                 <i class="fa fa-trash"></i>
                                            </button>`;
                        }
                        $('#AdministratorsTableBody').append(`
                            <tr>
                                <td>`+ element.name + `</td>
                                <td>`+ element.email + `</td>
                                <td  class="text-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" value="` +
                            element.id +
                            `" name="editAdministrator" class="btn btn-primary" id="editAdministrator" data-bs-toggle="modal" data-bs-target="#editAdministratorModal">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            `+ button + `
                                        </div>
                                </td>
                             </tr>
                        `);
                    });
                },
            });
        };
        getAdministrators();

        $(document).on('submit', '#addAdministratorForm', function () {
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
                    url: "{{ route('administrator.store') }}",
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        if (data == 1) {
                            $('#addAdministratorModal').modal('hide');
                            Swal.fire(
                                'Yeeeey!',
                                'Administrator Account Added!',
                                'success'
                            )

                            $('#addAdministratorForm').trigger('reset');
                            $('#AdministratorsTableBody').empty();
                            getAdministrators();
                        }
                    }
                })

            } else {
                $('#addAdministratorModal').modal('hide');
                Swal.fire(
                    'Eeek!',
                    'Password does not match!',
                    'error'
                )

                $('#addAdministratorForm').trigger('reset');
            }
        });

        $(document).on('click', "button[name='editAdministrator']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.edit', ':id')}}";
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

                $(document).on("submit", "#editAdministratorForm", function () {
                    let id = $('#id').val();
                    let name = $('#new_name').val();
                    let email = $('#new_email').val();

                    let route = "{{ route('administrator.update', ':id')}}";
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
                                $('#editAdministratorModal').modal('hide');
                                Swal.fire(
                                    'Yeeeey!',
                                    'Administrator Updated!',
                                    'success'
                                )

                                $('#editAdministratorForm').trigger('reset');
                                $('#AdministratorTableBody').empty();
                                getAdministrators();
                            } else {
                                $('#editAdministratorModal').modal('hide');
                                Swal.fire(
                                    'Eeek!',
                                    'Nothing Changes!',
                                    'error'
                                )

                                $('#editAdministratorForm').trigger('reset');
                            }
                        }
                    })
                });
        });

        $(document).on('click', "button[name='deleteAdministrator']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.destroy', ':id')}}";
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
                                    'Yeeeey!',
                                    'Administrator Deleted!',
                                    'success'
                                )
                                $('#AdministratorTableBody').empty();
                                getAdministrators();
                            } else {
                                Swal.fire(
                                    'Eeek!',
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