@extends('auth/log-main')
@section('judul_halaman', 'Register Page')
@section('content')
                                <!-- Register Page with cards -->
                                <div class="px-4">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4">Register Page</h1>
                                    </div>

                                    <div class="text-center text-lg">
                                        @if (\Session::has('pesan'))
                                            <div class="alert alert-success fade show" alert="alert">
                                                <p>{{!! \Session::get('pesan') !!}}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <form class="user" method="POST" action="{{route('register')}}">
                                        @csrf

                                        <div class="col-md-6 form-group">
                                            <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="Nama Lengkap" required autocomplete="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input id="username" type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{old('username')}}" placeholder="Username" required autocomplete="username">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Alamat Email" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="Password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Nama Lengkap" required autocomplete="new-password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block col-lg-4">
                                            {{ __('Register') }}
                                        </button>
                                        <hr>
                                        <div class="text-center text-lg mb-4">
                                            @if (Route::has('login'))
                                                <a class="small" href="{{route('login')}}">
                                                    {{ __('Already have an account? Log In') }}
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
@endsection
