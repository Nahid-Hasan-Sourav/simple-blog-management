<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Traits\ImageTraits;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    use ImageTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['image'] = $this->getImageUrl($request->file('image'), 'images/posts/');
        $validated['user_id'] = Auth::id();

        $featureImages = [];

        if ($request->hasFile('feature_images')) {
            foreach ($request->file('feature_images') as $file) {
                $featureImages[] = $this->getImageUrl($file, 'images/posts/feature_images/');
            }
        }

        // Assign the array directly to the feature_images attribute
        $validated['feature_images'] = $featureImages;

        $post = Post::create($validated);

        return response()->json([
            'status' => 'success',
            'post' => $post,
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
