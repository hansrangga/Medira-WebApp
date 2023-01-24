@extends('auth/log-main')
@section('content')
                                <!-- Reset Page with cards -->
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{route('password.update')}}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{$token}}">

                                        <div class="col-lg-6 form-group">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email')}}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </form>
                                </div>
@endsection
