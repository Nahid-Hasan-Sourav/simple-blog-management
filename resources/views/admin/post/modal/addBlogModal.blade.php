<!-- Modal -->

<div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Blog Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="submitBlogForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-4 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title"  >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="description"  id="editor" placeholder="Blog Description"  ></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-sm-4 control-label">Main Image</label>
                        <div class="col-sm-12">
                            <input type="file" id="image" name="image" class="dropify"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="feature_images" class="col-sm-4 control-label">Feature Images (Optional)</label>
                        <div class="col-sm-12">
                            <input type="file" id="feature_images" name="feature_images[]" class="dropify" multiple/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" style="cursor: pointer">Add Blog</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('blog.uploadImages', ['_token' => csrf_token()]) }}"
                }
            })
            .then(editor => {
                console.log('CKEditor initialized successfully');


            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });


    </script>

</div>
