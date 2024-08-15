@extends('layouts.app')

@section('body')
    <style>

        .carousel-caption {
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
        }
        .carousel-inner{
            height: 500px !important;
        }
    </style>

    <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel" data-mdb-carousel-init>
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button
                type="button"
                data-mdb-target="#carouselBasicExample"
                data-mdb-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"
            ></button>
            <button
                type="button"
                data-mdb-target="#carouselBasicExample"
                data-mdb-slide-to="1"
                aria-label="Slide 2"
            ></button>
            <button
                type="button"
                data-mdb-target="#carouselBasicExample"
                data-mdb-slide-to="2"
                aria-label="Slide 3"
            ></button>
        </div>

        <!-- Inner -->
        <div class="carousel-inner">
            <!-- Single item -->
            <div class="carousel-item active">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).webp" class="d-block w-100" alt="Sunset Over the City"/>
                <div class="carousel-caption   d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).webp" class="d-block w-100" alt="Canyon at Nigh"/>
                <div class="carousel-caption   d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).webp" class="d-block w-100" alt="Cliff Above a Stormy Sea"/>
                <div class="carousel-caption   d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <!-- Inner -->

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <!-- Carousel wrapper -->
    </div>
    <div class="text-center p-4 text-decoration-underline">
        <h3>ALL BLOGS</h3>
    </div>
    <div class="container-fluid px-0 mt-5" >
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

            @forelse($blogs as $blog)
                <a class="col text-decoration-none" href="{{ route('blog.show', $blog->id) }}">
                    <div class="card">
                        <img src="{{ $blog->image }}" class="card-img-top" style="height:250px" alt="Fissure in Sandstone">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>

                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 100) }}</p>

                        <small>posted by {{$blog->user->name}}</small>

                        </div>
                    </div>
                </a>
                @empty
                <p>No Blogs Found</p>

            @endforelse




        </div>
    </div>

@endsection
