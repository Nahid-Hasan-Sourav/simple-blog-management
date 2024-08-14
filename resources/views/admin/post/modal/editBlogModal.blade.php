<!-- Modal for Editing Blog Post -->
<div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Blog Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editBlogForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="editTitle" class="col-sm-12 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="title" id="editTitle" placeholder="Blog Title" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="editDescription" class="col-sm-12 control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="description" id="editDescription" placeholder="Blog Description"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="input-group flex-column">
                            <input type="file" id="input-file-now" name="image" class="dropify"/>
                            <img src="" width="150" height="200" id="editImage" style="display: none;" /> <!-- Initially hidden -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="editFeatureImages" class="col-sm-12 control-label">Feature Images (Optional)</label>
                        <p></p>
                        <div class="col-sm-12">
                            <input type="file" id="feature_images" name="feature_images[]" class="dropify" multiple />                        </div>
                    </div>

                    <div class="form-group row feature-images-container">
                        <label class="col-sm-12 control-label">Current Feature Images</label>
                        <div class="col-sm-12">
                            <div class="input-group flex-column" style="position: relative;">
                                <img src="" width="150" height="200" id="editImage" style="display: none; position: relative; z-index: 1;" />
                                <button class="btn btn-danger btn-sm remove-main-image" style="position: absolute; top: 10px; right: 10px; z-index: 2; display: none;">Remove</button>
                                <input type="file" id="input-file-now" name="image" class="dropify" />
                            </div>
                        </div>

                    </div>

                    <input type="hidden" id="editBtnId" name="id" /> <!-- Hidden input for blog ID -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" style="cursor: pointer">Update Blog</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editDescription'), {
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
