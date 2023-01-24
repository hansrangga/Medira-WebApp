@extends('auth/log-main')
@section('judul_halaman', 'Login Page')
@section('content')
                                <!-- Login Page with cards -->
                                <div class="px-4">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4">Login Page</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{route('login')}}">
                                        @csrf

                                        <div class="col-lg-6 form-group">
                                            <input id="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Email/Username" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4">
                                            {{ __('Login') }}
                                        </button>
                                        <hr>
                                        <div class="text-center text-lg">
                                            @if (Route::has('password.request'))
                                                <a class="small" href="{{route('password.request')}}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="text-center text-lg mb-1">
                                            @if (Route::has('register'))
                                                <a class="small" href="{{route('register')}}">
                                                    Don't have account? Register Here
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
@endsection
