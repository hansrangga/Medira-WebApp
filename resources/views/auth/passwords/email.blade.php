@extends('auth/log-main')
@section('content')
                                <!-- Email Page with cards -->
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{route('password.email')}}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{$token}}">

                                        <div class="col-lg-6 form-group">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Email/Username" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </form>
                                </div>
@endsection
