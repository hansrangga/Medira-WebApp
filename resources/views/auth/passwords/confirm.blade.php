@extends('auth/log-main')
@section('content')
                                <!-- Confirm Page with cards -->
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4">Confirm Password</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{route('password.confirm')}}">
                                        @csrf

                                        <div class="col-lg-6 form-group">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4">
                                            {{ __('Confirm Password') }}
                                        </button>
                                        <hr>
                                        <div class="text-center text-lg">
                                            @if (Route::has('password.request'))
                                                <a class="small" href="{{route('password.request')}}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
@endsection
