<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Edit Feature</h5>
    </div>
    <div class="modal-body">
        <form id="edit_feature_form" method="post">
            @csrf
            <input type="hidden" name="id" class="form-control" value="{{ $feature['id'] }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Feature Title</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $feature['title'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Feature Type</strong></label>
                <div class="col-sm-8">
                    <select class="form-control" name="type">
                        <option value="1" {{$feature['type'] == 1 ? 'selected' : ''}}>Interior Feature</option>
                        <option value="2" {{$feature['type'] == 2 ? 'selected' : ''}}>Exterior Finish</option>
                        <option value="3" {{$feature['type'] == 3 ? 'selected' : ''}}>Featured Amenities</option>
                        <option value="4" {{$feature['type'] == 4 ? 'selected' : ''}}>Appliances</option>
                        <option value="5" {{$feature['type'] == 5 ? 'selected' : ''}}>Views</option>
                        <option value="6" {{$feature['type'] == 6 ? 'selected' : ''}}>Heating</option>
                        <option value="7" {{$feature['type'] == 7 ? 'selected' : ''}}>Cooling</option>
                        <option value="8" {{$feature['type'] == 8 ? 'selected' : ''}}>Roof</option>
                        <option value="9" {{$feature['type'] == 9 ? 'selected' : ''}}>Sewer-Water Systems</option>
                        <option value="10" {{$feature['type'] == 10 ? 'selected' : ''}}>Extra Features</option>
                    </select>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_feature_button">Save Changes</button>
    </div>