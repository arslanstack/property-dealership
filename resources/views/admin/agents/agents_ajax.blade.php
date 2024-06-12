<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Edit Real Estate Agent</h5>
    </div>
    <div class="modal-body">
        <form id="edit_agent_form" method="post">
            @csrf
            <input type="hidden" name="id" class="form-control" value="{{ $agent['id'] }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Image</strong></label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-10 mr-0 pr-0">
                            <input type="file" name="image" id="agent_img_input" class="form-control" required accept="image/*">
                        </div>
                        <div class="col-sm-2 ml-0 pl-0">
                            <img id="previewImage" src="{{asset('uploads/agents/' . $agent['image'] )}}" style="width: 50px; height: 40px; object-fit:contain;" alt="">
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Name</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" placeholder="name" required value="{{ $agent['name'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Designation</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="designation" required class="form-control" value="{{$agent->designation}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Phone</strong></label>
                <div class="col-sm-8">
                    <input type="phone" name="phone" required class="form-control" value="{{$agent->phone}}">
                </div>
            </div>
            <div class=" form-group row">
                <label class="col-sm-4 col-form-label"><strong>Description</strong></label>
                <div class="col-sm-8">
                    <textarea name="description" required class="form-control" rows="3" id="">{{$agent->description}}</textarea>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_agent_button">Save Changes</button>
    </div>