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
            <div class="form-group">
               <div class="row">
                   <div class="col-4">
                       <label for="search"></label>
                       <input type="text" class="form-control" id="search" placeholder="Search By Title">
                   </div>

                   <div class="col-4">
                       <label for="order"></label>
                       <select class="form-control" id="order">
                           <option value="">Sort by Date</option>
                           <option value="asc">Oldest First</option>
                           <option value="desc">Newest First</option>
                       </select>
                   </div>


               </div>

            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Feature Images</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="blogTable">
                <!-- Blog rows will be dynamically populated here -->
                </tbody>
            </table>
        </div>

    </div>


    {{-- added create penalty modal --}}
    @include('admin.post.modal.addBlogModal')
    @include('admin.post.modal.editBlogModal')


@push('scripts')
    <script>

        const showAllBlogDataOnTabel = () => {
            $.ajax({
                url: "{{ route('blogs.all') }}",
                type: "GET",
                success: function (res) {
                    if (res.status === "success") {
                        let data = res.data;
                        showTableData(data);
                    }
                },
            });
        };

        showAllBlogDataOnTabel();
        const showTableData = (data) => {
            const tableBody = $("#blogTable");
            tableBody.empty();
            console.log("Data === : ", data);
            if (data.length > 0) {
                data.forEach((item, index) => {
                    console.log('image',item.image);
                    const row =
                        `
                        <tr>
                           <th scope="row">${index + 1}</th>
                           <td>${item.title}</td>

                           <td>
                           <img src="${item.image}" alt="img" width="50px" height="50px">
                           </td>
                           <td>
                              ${item.feature_images.map((img, index) => {
                                return `<img src="${item.image}" alt="img" width="50px" class="mr-2" height="50px">`
                              })}
                           </td>
                           <td>
                               <div class="div">
                                   <button class="btn btn-sm btn-success productEditBtn" value="${item.id}" onclick="editBlog(event)">
                                       <i class="fa-solid fa-pen-to-square"></i>
                                   </button>
                                   <button class="btn btn-sm btn-danger productDeleteBtn" value="${item.id}" onclick="deleteBlog(event)">
                                       <i class="fa-solid fa-trash"></i>
                                   </button>
                               </div>
                           </td>
                         </tr>
                        `;
                    tableBody.append(row);
                });
            } else {
                tableBody.append('<tr><td colspan="5">No data available</td></tr>');
            }
        };

        $(document).ready(function () {
            showAllBlogDataOnTabel();

            $(".blogButton").click(function () {
              $("#blogModal").modal('show');

            });

            //create blog start here
            $("#submitBlogForm").submit(function (e) {
                e.preventDefault();
                const form = e.target;
                const title = form.title.value;
                const description = form.description.value;
                const image = form.image.files[0];
                const feature_images = form.feature_images.files;

                const formData = new FormData();

                formData.append("title", title);
                formData.append("description", description);
                formData.append("image", image);

                // Append each selected feature image to the FormData object
                for (let i = 0; i < feature_images.length; i++) {
                    formData.append("feature_images[]", feature_images[i]);
                }

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    url: "{{ route('blogs.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === "success") {
                            console.log("Response store === : ", response);
                            showAllBlogDataOnTabel();
                            form.reset();
                            $("#blogModal").modal("hide");


                            Swal.fire({
                                icon: 'success',
                                title: 'Blog Added',
                                text: 'The Blog has been successfully added.',
                                timer: 5000,
                                showConfirmButton: true
                            })
                        }
                    },
                    error: function (xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            Object.keys(response.errors).forEach(function (field) {
                                response.errors[field].forEach(function (errorMessage) {
                                    toastr.error(errorMessage);
                                });
                            });
                        }
                    },
                });
            });
            //create blog end here



        });

        //delete blog start here
        const deleteBlog = (e) => {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            let id = e.currentTarget.value;
            console.log("delete id",id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('blogs.destroy', '') }}/" + id,
                        type: "DELETE",


                        success: function (res) {
                            console.log("Response === : ", res)
                            if (res.status === "success") {

                                Swal.fire({
                                    title:"Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                showAllBlogDataOnTabel();
                            }
                        },
                    });

                }



            });
        };
        //delete blog end here


        //edit blog start here
        const editBlog = (e) => {
            $("#editBlogModal").modal("show");
            let id = e.currentTarget.value;

            $.ajax({
                url: `blogs/${id}/edit`, // Fetch blog data
                type: "GET",
                success: function (res) {
                    if (res.status === "success") {
                        // Populate the form fields
                        $("#editTitle").val(res.data.title);
                        $("#editDescription").val(res.data.description);
                        $("#editImage").attr("src", res.data.image).show(); // Show main image
                        $("#editBtnId").val(res.data.id);



                        // Clear any existing feature images before appending new ones
                        $(".feature-images-container").empty();

                        // Display feature images
                        if (res.data.feature_images.length > 0) {
                            res.data.feature_images.forEach((img) => {
                                const imgElement = `
                            <div class="feature_images" style="display: inline-block; margin-right: 10px;">
                                <img src="${img}" width="150" height="150" class="mr-2" />
                            </div>`;
                                $(".feature-images-container").append(imgElement);
                            });
                        } else {
                            $(".feature-images-container").append('<p>No feature images available.</p>');
                        }

                    }
                },
                error: function (xhr) {
                    console.error("Error fetching blog data:", xhr);
                },
            });
        };

        // Update blog form submission
        $("#editBlogForm").submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Set up CSRF token for the request
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            const form = e.target; // Get the form element
            const title = form.title.value;
            const description = form.description.value;
            const image = form.image.files[0]; // Get the main image file
            const feature_images = form.feature_images.files; // Get feature images files

            // Create a FormData object to send form data
            const formData = new FormData();
            formData.append("title", title);
            formData.append("description", description);

            // Append the main image if it exists
            if (image) {
                formData.append("image", image);
            }

            // Append each selected feature image to the FormData object
            for (let i = 0; i < feature_images.length; i++) {
                console.log("test image",feature_images[i])
                formData.append("feature_images[]", feature_images[i]);
            }

            // Add the _method field to simulate a PUT request
            formData.append('_method', 'PUT');

            // Perform the AJAX request to update the blog
            $.ajax({
                url: `blogs/${form.id.value}`,
                type: "POST", // Use POST since you're sending form data
                data: formData,
                contentType: false, // Prevent jQuery from overriding content type
                processData: false, // Prevent jQuery from converting the data to a query string
                success: function (response) {
                    console.log("Response Updated data: ", response);
                    if (response.status === "success") {
                        $("#editBlogModal").modal("hide"); // Hide the modal if success
                        Swal.fire({
                            icon: 'success',
                            title: 'Blog Updated',
                            text: 'The blog has been successfully updated.',
                            timer: 5000,
                            showConfirmButton: true
                        });
                        showAllBlogDataOnTabel(); // Refresh the blog data table
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error: ", error);
                    const response = JSON.parse(xhr.responseText);
                    console.log("Error Message: ", response.message);
                },
            });
        });

        // Search functionality
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let searchTerm = $(this).val().toLowerCase();

                $.ajax({
                    url: "{{ route('blogs.all') }}",
                    type: "GET",
                    data: { search: searchTerm }, // Pass searchTerm as query param
                    success: function (res) {
                        if (res.status === "success") {
                            let data = res.data;
                            showTableData(data);
                        }
                    },
                });
            });
        });

        // Sorting functionality
        $(document).ready(function() {
            $('#order').on('change', function() {
                let order = $(this).val();

                $.ajax({
                    url: "{{ route('blogs.all') }}",
                    type: "GET",
                    data: {
                        order: order,
                    },
                    success: function (res) {
                        if (res.status === "success") {
                            let data = res.data;
                            showTableData(data);
                        }
                    },
                });
            });
        });



    </script>
@endpush

@endsection
