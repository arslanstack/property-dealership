<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Edit Testimonial</h5>
    </div>
    <div class="modal-body">
        <form id="edit_testimonial_form" method="post">
            @csrf
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Image</strong></label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-10 mr-0 pr-0">
                            <input type="file" required name="image" id="testimonial_img_input" class="form-control" accept="image/*">
                        </div>
                        <div class="col-sm-2 ml-0 pl-0">
                            <img id="previewImage" src="{{asset('uploads/testimonials/' . $testimonial['image'] )}}" style="width: 50px; height: 40px; object-fit:contain;" alt="">
                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" name="id" class="form-control" value="{{ $testimonial['id'] }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Name</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" placeholder="name required" value="{{ $testimonial['name'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Profession</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="designation" class="form-control" placeholder="designation" required value="{{ $testimonial['designation'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>City/Country</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="location" class="form-control" placeholder="location" required value="{{ $testimonial['location'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Content</strong></label>
                <div class="col-sm-8">
                    <!-- <input type="text" name="content" class="form-control" placeholder="content" value=""> -->
                    <textarea name="content" class="form-control" required>{{ $testimonial['content'] }}</textarea>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_testimonial_button">Save Changes</button>
    </div>