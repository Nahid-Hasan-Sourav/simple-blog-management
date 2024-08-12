
@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-5 vh-100">
                <div class="card">
                    <form class="card-body " action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="my-3 img-fluid profile-image-pic img-thumbnail rounded-circle"
                                 alt="profile"
                                 style="width:120px; height:120px; object-fit:cover;"
                            >
                            <h4 class="my-2 fw-bold">CRATE AN ACCOUNT</h4>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="Username" aria-describedby="emailHelp"
                                   name="name"
                                   placeholder="Name">
                            @error('name')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <input type="email" class="form-control" id="Username" aria-describedby="emailHelp"
                                   name="email"
                                   placeholder="email">
                            @error('email')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" aria-describedby="emailHelp"
                                   name="password"
                                   placeholder="password">
                            @error('password')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="emailHelp" class="mb-2 text-center form-text text-dark">Already an account? <a href="{{route('login')}}" class="text-dark fw-bold"> Login
                            </a>
                        </div>




                        <div class="px-3 my-4 text-center row">
                            <button type="submit" class="px-5 mb-1 btn btn-color w-100 btn-success text-uppercase fw-bold">sign up</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
