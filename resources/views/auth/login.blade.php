@extends('layouts.app-auth') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card auth" style="border-radius: 20px !important; min-height: 453px;">
                <div class="card-header">{{ __("Login") }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img src="{{ asset('img/user-128.svg') }}" class="border border-light" alt="" width="100" height="100" style="border-radius: 50%">
                                    </div>
                                </div>
                                <div class="row">
                                    <label
                                        for="email"
                                        class="col-md-12 col-form-label text-md-start"
                                        >{{ __("Email Address") }}</label
                                    >
                                </div>
                                <div class="">
                                    <div class="col-md-12">
                                        <input
                                            id="email"
                                            type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="email"
                                            autofocus
                                        />
        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="row">
                                    <label
                                        for="password"
                                        class="col-md-12 col-form-label text-md-start"
                                        >{{ __("Password") }}</label
                                    >
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                        />
        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input"
                                    type="checkbox" name="remember"
                                    id="remember"
                                    {{ old("remember") ? "checked" : "" }}>

                                    <label
                                        class="form-check-label"
                                        for="remember"
                                    >
                                        {{ __("Remember Me") }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                @if (Route::has('password.request'))
                                <a
                                    class="btn btn-link-auth text-end"
                                    href="{{ route('password.request') }}"
                                >
                                    {{ __("Forgot Your Password?") }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary w-75">
                                    {{ __("Login") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
