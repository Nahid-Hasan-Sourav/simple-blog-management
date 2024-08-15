@extends('layouts.app')

@section('body')

    <div class="container">

        <div class="card mb-4 position-relative">
            <img src="{{ asset($blog->image) }}" class="card-img-top" style="height: 350px; opacity: 0.5;" alt="image"/>
            <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-white">
                <h5 class="card-title text-center text-primary">{{ $blog->title }}</h5>
                <p class="card-text text-center text-primary">Last updated {{ $blog->updated_at->diffForHumans() }}</p>
                <small class="text-center text-primary">Posted By: {{ $blog->user->name }}</small>
            </div>
        </div>

        <div>
            <p class="card-text text-center">{!! $blog->description !!}</p>
        </div>

        <div class="feature-images mt-4">
            @if($blog->feature_images && count($blog->feature_images) > 0)
                <div class="row">
                    @foreach($blog->feature_images as $image)
                        <div class="col-md-3 mb-2">
                            <img src="{{ asset($image) }}" alt="Feature Image" class="img-fluid rounded" style="width: 200px; height: 200px;">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

@endsection
