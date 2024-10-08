<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Traits\ImageTraits;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
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

    public function getAllBlogs(): JsonResponse
    {
        // Authorize the user to view their blogs
        Gate::authorize('viewAny', Blog::class);

        // Get the search term and order from the query parameters
        $search = request()->query('search', '');
        $order = request()->query('order', '');

        // Query blogs with optional filtering by title and ordering by created_at
        $posts = Blog::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($order, function ($query, $order) {
                return $query->orderBy('created_at', $order);
            })
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $posts,
        ], 200);
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
    public function store(StoreBlogRequest $request): JsonResponse
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

        $post = Blog::create($validated);

        return response()->json([
            'status' => 'success',
            'post' => $post,
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Blog $post)
    {

    }
    //upload image  for ck editor
    public function uploadImages(Request $request){
        if ($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog): JsonResponse
    {
        Gate::authorize('view', $blog);

        return response()->json([
            'status' => 'success',
            'data' => $blog,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog): JsonResponse
    {
        Gate::authorize('update', $blog);

        $validatedData = $request->validated();

        // Check if a new main image is uploaded
        if ($request->hasFile('image')) {
            // Check if the old image exists and delete it
            if (file_exists(public_path($blog->image)) && isset($blog->image)) {
                File::delete(public_path($blog->image));
            }

            // Update the image path with the new image
            $validatedData['image'] = $this->getImageUrl($request->file('image'), 'upload/blog/');
        }


        // Handle feature images
        if ($request->hasFile('feature_images')) {
            foreach ($blog->feature_images as $oldImage) {
                if (file_exists(public_path($oldImage))) {
                    File::delete(public_path($oldImage));
                }
            }

            // Store new feature images
            $featureImages = [];
            foreach ($request->file('feature_images') as $image) {
                $featureImages[] = $this->getImageUrl($image, 'upload/blog/feature_images/');
            }

            $validatedData['feature_images'] = $featureImages;
        }

        // Save the updated blog post
        $blog=$blog->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => $blog,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): JsonResponse
    {
        Gate::authorize('delete', $blog);
        $blog->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Post deleted successfully',

        ], 200);

    }
}
