<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Home Evaluation Request Details</h5>
    </div>
    <div class="modal-body">
        <form id="edit_type_form" method="post">
            @csrf
            <input type="hidden" name="id" class="form-control" value="{{ $eval['id'] }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>First Name</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="fname" class="form-control" placeholder="fname" value="{{ $eval['fname'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Last Name</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="lname" class="form-control" placeholder="lname" value="{{ $eval['lname'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Email</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="email" class="form-control" placeholder="email" value="{{ $eval['email'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Phone</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="phone" class="form-control" placeholder="phone" value="{{ $eval['phone'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Address <small>(Line 1)</small></strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="address" class="form-control" placeholder="address" value="{{ $eval['address'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>City</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="city" class="form-control" placeholder="city" value="{{ $eval['city'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>State</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="state" class="form-control" placeholder="state" value="{{ $eval['state'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Zip Code</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="zip" class="form-control" placeholder="zip" value="{{ $eval['zip'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Year Built</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="year_built" class="form-control" placeholder="year_built" value="{{ $eval['year_built'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Size <small>(sqft)</small></strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="size" class="form-control" placeholder="size" value="{{ $eval['size'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Bedrooms</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="bedroom" class="form-control" placeholder="bedroom" value="{{ $eval['bedroom'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Bathrooms</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="bathroom" class="form-control" placeholder="bathroom" value="{{ $eval['bathroom'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Half Bathroom</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="half_bathroom" class="form-control" placeholder="half_bathroom" value="{{ $eval['half_bathroom'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Has Suite</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapHasSuite($eval['has_suite']) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Garage</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapGarage($eval['garage']) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Garage Type</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapGarageType($eval['garage_type']) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Basement Type</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapBaseType($eval['basement_type']) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Development Level</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapDevLvl($eval['dev_lvl']) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Plan to Move</strong></label>
                <div class="col-sm-8">
                    <input type="text" disabled name="" class="form-control" placeholder="" value="{{ mapMovePlan($eval['move_plan']) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Notes</strong></label>
                <div class="col-sm-8">
                    <p>{{$eval['notes']}}</p>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_type_button">Save Changes</button>
    </div>