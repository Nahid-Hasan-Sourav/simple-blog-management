@extends('admin.layouts.app')

@section('body')
    <div class="container">
        <div class="card">
            <div class="card-body d-flex justify-content-between">
                <h2>Blog</h2>
                <button style="cursor: pointer" class="btn btn-md btn-success blogButton">ADD BLOG</button>
            </div>

        </div>
        <div class="div">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Sub-Category Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="blogTable">
                {{-- <tr>
                   <th scope="row">{{ $loop->iteration }}</th>
                   <td> {{ $data->Category->name }}</td>
                   <td>

                       {{ $data->name }}
                   </td>
                   <td>
                       <div class="div">
                           <a href="{{ route('subcategory.edit',['id'=>$data->id]) }}"  class="btn btn-sm btn-success">
                               <i class="fa-solid fa-pen-to-square"></i>
                           </a>
                           <a href="{{ route('subcategory.delete',['id'=>$data->id]) }}" class="btn btn-sm btn-danger">
                               <i class="fa-solid fa-trash"></i>
                           </a>
                       </div>
                   </td>
                 </tr> --}}


                </tbody>
            </table>
            <!-- Pagination Links -->
            {{-- {{$allData->links()}} --}}
        </div>
    </div>


    {{-- added create penalty modal --}}
    @include('admin.post.modal.addBlogModal')
    @include('admin.post.modal.editBlogModal')


@push('scripts')
    <script>


        $(document).ready(function () {

            $(".blogButton").click(function () {
              $("#blogModal").modal('show');

            });

            $("#submitBlogForm").submit(function (e) {
                e.preventDefault(); // Prevent the default form submission
                const form = e.target;
                const title = form.title.value;
                const description = form.description.value;
                const image = form.image.files[0];
                const feature_images = form.feature_images.files; // Get the selected files

                const formData = new FormData();

                formData.append("title", title);
                formData.append("description", description);
                formData.append("image", image);

                // Append each selected feature image to the FormData object
                for (let i = 0; i < feature_images.length; i++) {
                    formData.append("feature_images[]", feature_images[i]);
                }

                console.log("Form submitted via jQuery", formData);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "{{ route('posts.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log("submit form data == : ", response);
                        if (response.status === "failed") {
                            response.message.forEach(function (error) {
                                toastr.error("Validation Error: " + error);
                            });
                        }
                        if (response.status === "success") {
                            form.reset();
                            $("#productModal").modal("hide");

                            Swal.fire({
                                icon: 'success',
                                title: 'Product Added',
                                text: 'The Product has been successfully added.',
                                timer: 5000,
                                showConfirmButton: true
                            })
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: ", error);
                        var response = JSON.parse(xhr.responseText);
                        console.log("Error Message: ", response.message);
                    },
                });
            });







        });




    </script>
@endpush

@endsection
