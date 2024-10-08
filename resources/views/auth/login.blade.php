@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 ">
                <div class="my-5 card">
                    <h3 class="text-center text-success">{{Session::get('registration-message') }}</h3>
                    <form class="card-body p-lg-5" action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="my-3 img-fluid profile-image-pic img-thumbnail rounded-circle"
                                 alt="profile"
                                 style="width:120px; height:120px; object-fit:cover;"
                            >
                            <h4 class="my-2 fw-bold">Sign in here</h4>
                        </div>

                        <div class="mt-3 mb-3">
                            <input type="text" name="email" class="form-control" id="Username" aria-describedby="emailHelp"
                                   placeholder="Email">
                            @error('email')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input name="password" type="password" class="form-control" id="password" placeholder="password">

                            @error('password')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="w-100 h-0 btn btn-success text-uppercase fw-bold">Login</button>
                        </div>

                        <div id="emailHelp" class="mb-2 text-center form-text text-dark">Don't have an account? <a href="{{route('register')}}" class="text-dark fw-bold"> Create an
                                Account</a>
                        </div>

                        <div id="emailHelp" class="mb-2 text-center form-text text-dark">
                            <a href="{{route('password.request')}}" class="text-dark fw-bold">
                                Forgot Password

                            </a>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
