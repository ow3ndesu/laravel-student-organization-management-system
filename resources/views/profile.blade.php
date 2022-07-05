@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Profile") }}</div>

                <div class="card-body">
                    <form id="updateProfile" action="javascript:void(0);" method="PUT">
                        @csrf
                        <input type="hidden" name="oldPassword" id="oldPassword" value="{{ Auth::user()->password}}" />
                        <input type="hidden" name="_method" value="PUT" />

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __("Name") }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ Auth::user()->name }}" required autocomplete="name"
                                    autofocus />

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __("Email Address")
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ Auth::user()->email }}" required autocomplete="email" />

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __("Confirm
                                Password") }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name=password-confirm"
                                    required autocomplete="password-confirm" />
                            </div>

                            @if(isset($passworderror))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $passworderror }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Update Details") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Remove Vue Error -->
</div>
</div>

<script>
    $(document).ready(function (e) {

        $(document).on('submit', '#updateProfile', function (data) {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password-confirm').val();

            let route = "{{ route('profile.update')}}";

            let formData = new FormData();
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("_method", 'POST');
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);

            $.ajax({
                url: route,
                method: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    if (data != 'Password is incorrect!') {
                        if (data == 1) {

                            Swal.fire(
                                'Yeeeey!',
                                'Profile Updated!',
                                'success'
                            )
                        } else if (data == 0) {
                            Swal.fire(
                                'Eeek!',
                                'Nothing changes!',
                                'error'
                            )
                        } else {
                            Swal.fire(
                                'Eeek!',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    } else {
                        Swal.fire(
                            'Eeek!',
                            data,
                            'error'
                        )
                    }
                }
            })

        })
    })
</script>
@endsection