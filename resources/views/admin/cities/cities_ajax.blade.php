<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Edit City</h5>
    </div>
    <div class="modal-body">
        <form id="edit_city_form" method="post">
            @csrf
            <input type="hidden" name="id" class="form-control" value="{{ $city['id'] }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>City</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ $city['name'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>State/Province</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="state" required class="form-control" placeholder="state" value="{{ $city['state'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Country</strong></label>
                <div class="col-sm-8">
                    <select name="country" required class="form-control" style="height: 2.22rem !important;" id="">
                        @php
                        $countries = country_select();
                        @endphp

                        @foreach($countries as $country)
                        <option value="{{$country}}" {{$city['country'] == $country ? 'selected' : ''}}>{{$country}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_city_button">Save Changes</button>
    </div>