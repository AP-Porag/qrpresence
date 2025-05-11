@extends('layouts.master')

@section('content')
    <div class="account-pages">
        <!-- Begin page -->
        <div class="accountbg" style="background: url('admin/images/bg.jpg');background-size: cover;background-position: center;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card shadow-none">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="{{route('login')}}"><img src="admin/images/logo-sm.png" height="22" alt="logo"></a>
                                </div>

                                <h4 class="font-size-18 mt-5 text-center">Create an account !</h4>
                                <p class="text-muted text-center">Sign up to continue.</p>

                                <form method="POST" action="{{ route('register') }}">

                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="first_name">First Name</label>
                                        {{--                                        <input type="text" class="form-control" id="username" placeholder="Enter email">--}}

                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="last_name">Last Name</label>
                                        {{--                                        <input type="text" class="form-control" id="username" placeholder="Enter email">--}}

                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
{{--                                        <input type="text" class="form-control" id="username" placeholder="Enter email">--}}

                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="user_type">User Type</label>

                                        <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror" required>
                                            <option value="student" {{ old('user_type') == 'student' ? 'selected' : '' }}>Student</option>
                                            <option value="instructor" {{ old('user_type') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                                            <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>

                                        @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
{{--                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password">--}}
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-confirm">Confirm Password</label>

                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="mb-3 row">
{{--                                        <div class="col-sm-6">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input type="checkbox" class="form-check-input" id="customControlInline">--}}
{{--                                                <label class="form-check-label" for="customControlInline">Remember me</label>--}}

{{--                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                                <label class="form-check-label" for="remember">--}}
{{--                                                    {{ __('Remember Me') }}--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="offset-md-6 col-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Sign Up</button>
                                        </div>

                                        <div class="pt-4">
                                            <p>Already have an account? <a href="{{ route('login') }}" class="fw-medium text-primary">Login</a></p>
                                        </div>
                                    </div>

{{--                                    <div class="mb-3 mt-2 mb-0 row">--}}
{{--                                        <div class="col-12 mt-3">--}}
{{--                                            <a href="pages-recoverpw-2.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </form>

                                <div class="mt-5 pt-4 text-center">
{{--                                    <p>Don't have an account ? <a href="pages-register-2.html" class="fw-medium text-primary"> Signup now </a> </p>--}}
{{--                                    <p>© <script>document.write(new Date().getFullYear())</script> Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>--}}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
