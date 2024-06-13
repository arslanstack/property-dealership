@extends('admin.admin_app')
@push('styles')

<script src="{{asset('admin_assets/css/plugins/select2/select2.min.css')}}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    .wrapper {
        padding: 100px;
    }

    .image--cover {
        width: 40px;
        height: 40px;
        border: 1px solid gray;
        border-radius: 50%;
        /* margin: 20px; */

        object-fit: cover;
        object-position: center right;
        box-shadow: 0px -3px 5px 0px rgba(196, 189, 189, 0.75);
        -webkit-box-shadow: 0px -3px 5px 0px rgba(196, 189, 189, 0.75);
        -moz-box-shadow: 0px -3px 5px 0px rgba(196, 189, 189, 0.75);
    }

    td {
        background-color: #FFFFFF !important;
    }

    .ck.ck-reset.ck-editor.ck-rounded-corners {
        box-sizing: border-box;
        height: auto;
        position: static;
        width: 100%;
    }

    .switch-container {
        display: flex;
        flex-direction: column;
        align-items: start;
        margin-top: 29px;
        margin-left: -118px;
    }

    .ck-editor__editable_inline {
        min-height: 500px;
    }
</style>
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Add New Neighborhood </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/neighborhoods') }}"> Neighborhoods </a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Add New Neighborhood </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary text-white t_m_25" href="{{url('admin/neighborhoods')}}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Neighborhoods
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form action="{{url('admin/neighborhoods/store')}}" class="m-4" id="neighborhood-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Title</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="title" id="title-content" placeholder="e.g. Downtown Los Angeles" required class="form-control">
                                    </div>
                                    <label class="col-sm-2 col-form-label ps-3"><strong>Image</strong></label>
                                    <div class="col-sm-4">
                                        <input type="file" name="banner" id="Bannerimage" required class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <label class="col-sm-2 col-form-label"><strong>Zip Code</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="zip" required class="form-control" placeholder="e.g. 90012">
                                    </div>
                                    <label class="col-sm-2 col-form-label"><strong>City/Town <a data-toggle="modal" data-target="#add_modalbox" class="text-navy ml-1" style="text-decoration: underline;" type="button">Add New</a></strong></label>
                                    <div class="col-sm-4">
                                        <select name="city" id="cities_select" required class="select2 form-control" style="height: 2.22rem !important;" id="">
                                            @foreach($cities as $city)
                                            <option value="{{$city->name}}" {{$city->name == "Rosarito" ? 'selected' : ''}}>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label"><strong>Location (Select Latitude & Longitude Coordinates By Clicking The Map)</strong></label>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div id="map" style="height: 50vh !important;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"><strong>Latitude</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="latitude" id="latitude" class="form-control" required>
                                    </div>
                                    <label class="col-sm-2 col-form-label ps-3"><strong>Longitude</strong></label>
                                    <div class="col-sm-4">
                                        <input type="text" name="longitude" id="longitude" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label"><strong>Featured Amenities</strong></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Amenity 1</th>
                                                        <th scope="col">Amenity 2</th>
                                                        <th scope="col">Amenity 3</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Icon</th>
                                                        <td>
                                                            <label for="amenity_img1" style="cursor:pointer;">
                                                                <div class="wrapper">
                                                                    <img src="{{asset('assets/upload_images/iconer.png')}}" class="image--cover" id="amenity_icon1" alt="">
                                                                </div>
                                                            </label>
                                                            <input type="file" accept="image/*" class="form-control d-none" name="amenity_icon1" id="amenity_img1">
                                                        </td>
                                                        <td>
                                                            <label for="amenity_img2" style="cursor:pointer;">
                                                                <div class="wrapper">
                                                                    <img src="{{asset('assets/upload_images/iconer.png')}}" class="image--cover" id="amenity_icon2" alt="">
                                                                </div>
                                                            </label>
                                                            <input type="file" accept="image/*" class="form-control d-none" name="amenity_icon2" id="amenity_img2">
                                                        </td>
                                                        <td>
                                                            <label for="amenity_img3" style="cursor:pointer;">
                                                                <div class="wrapper">
                                                                    <img src="{{asset('assets/upload_images/iconer.png')}}" class="image--cover" id="amenity_icon3" alt="">
                                                                </div>
                                                            </label>
                                                            <input type="file" accept="image/*" class="form-control d-none" name="amenity_icon3" id="amenity_img3">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Title</th>
                                                        <td><input type="text" class="form-control" required name="amenity_title1"></td>
                                                        <td><input type="text" class="form-control" required name="amenity_title2"></td>
                                                        <td><input type="text" class="form-control" required name="amenity_title3"></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Description</th>
                                                        <td><textarea name="amenity_desc1" required class="form-control"></textarea></td>
                                                        <td><textarea name="amenity_desc2" required class="form-control"></textarea></td>
                                                        <td><textarea name="amenity_desc3" required class="form-control"></textarea></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="images" class="form-label"><strong>Images Gallery</strong></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dropzone col-12" id="myDropzone"></div>
                                    </div>
                                    <input type="text" name="images" id="images" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="description" class="form-label"><strong>Description</strong></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <textarea class="form-control" id="description" name="description" hidden placeholder="Enter the Description" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-md-12 justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Neighborhood</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal show fade" id="add_modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Add New City</h5>
            </div>
            <div class="modal-body">
                <form id="add_city_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>City</strong></label>
                        <div class="col-sm-8">
                            <input type="text" name="name" required class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>State/Province</strong></label>
                        <div class="col-sm-8">
                            <input type="text" name="state" required class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Country</strong></label>
                        <div class="col-sm-8">
                            <select name="country" required class="form-control" style="height: 2.22rem !important;" id="">
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-bissau">Guinea-bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iranf</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic Peoples Republic of">Korea, Democratic Peoples Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao Peoples Democratic Republic">Lao Peoples Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-leste">Timor-leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_city_button"> Submit </button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="{{asset('admin_assets/js/plugins/select2/select2.full.min.js')}}"></script>

<script>
    $(".select2").select2({
        placeholder: "Select an option",
        allowClear: true
    });
</script>
<script>
    gallery_images = [];
    let myDropzone = new Dropzone("#myDropzone", {
        url: "{{url('/admin/neighborhoods/imageManagement')}}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            if (response.status === 'success') {
                gallery_images.push(response.image);
                console.log(gallery_images);
                $('#images').val(JSON.stringify(gallery_images));
            } else {
                console.error('Error uploading images');
            }
        }
    });
</script>
<script>
    // on form submit i want to validate request 
    $('#neighborhood-form').submit(function() {
        if (gallery_images.length < 1) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.error("Please upload at least one image for the gallery");
            return false;
        }

        if ($('#latitude').val() == '' || $('#longitude').val() == '') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.error("Please select the latitude and longitude coordinates");
            return false;
        }
        if ($('#amenity_img1').val() == '' || $('#amenity_img2').val() == '' || $('#amenity_img3').val() == '') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.error("Please upload all the amenity images");
            return false;
        }
        return true;
    });
</script>
<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })
    ({
        key: "AIzaSyBy2l4KGGTm4cTqoSl6h8UAOAob87sHBsA",
        v: "weekly"
    });
</script>

<script>
    async function initMap() {
        const {
            Map
        } = await google.maps.importLibrary("maps");
        const myLatlng = {
            lat: 32.35269,
            lng: -117.0417087
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: myLatlng,
        });
        let infoWindow = new google.maps.InfoWindow({
            content: "Click on the map to select coordinates.",
            position: myLatlng,
        });
        infoWindow.open(map);
        map.addListener("click", (mapsMouseEvent) => {
            infoWindow.close();
            infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
            });
            coordinates = mapsMouseEvent.latLng.toJSON();
            infoWindow.setContent(
                "Latitude: " + coordinates.lat + "<br>Longitude: " + coordinates.lng,
            );
            infoWindow.open(map);
            $('#latitude').val(coordinates.lat);
            $('#longitude').val(coordinates.lng);
        });
    }

    initMap();
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
        ckfinder: {
            uploadUrl: "{{ url('admin/ckeditor-upload').'?_token='.csrf_token() }}"
        },
        toolbar: {
            items: [
                'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'underline', 'code', 'removeFormat', '|',
                'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', '|',
                'specialCharacters', '|',
            ],
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        placeholder: 'Enter Description Here!',

        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },

        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },

        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'AIAssistant',
            'CKBox',
            'CKFinder',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents',
            'PasteFromOfficeEnhanced'
        ]
    });
</script>
<script>
    var session = "{{Session::has('error') ? 'true' : 'false'}}";
    if (session == 'true') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right"
        }
        toastr.error("{{Session::get('error')}}");

    }
    $('#amenity_img1').change(function() {
        $('#amenity_icon1').show();
        $('#amenity_icon1').attr('src', URL.createObjectURL(event.target.files[0]));
    });
    $('#amenity_img2').change(function() {
        $('#amenity_icon2').show();
        $('#amenity_icon2').attr('src', URL.createObjectURL(event.target.files[0]));
    });
    $('#amenity_img3').change(function() {
        $('#amenity_icon3').show();
        $('#amenity_icon3').attr('src', URL.createObjectURL(event.target.files[0]));
    });
</script>
<script>
    $(document).on("click", "#save_city_button", function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = new FormData($("#add_city_form")[0]);
        $.ajax({
            url: "{{ url('admin/neighborhoods/addCity') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                console.log(status);
                if (status.msg == 'success') {
                    $("#add_city_form")[0].reset();
                    btn.ladda('stop');
                    toastr.success(status.response, "Success");
                    console.log(status)
                    $('#cities_select').append(new Option(status.city.name, status.city.name, true, true)).trigger('change');
                    $('#add_modalbox').modal('hide');
                } else if (status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    btn.ladda('stop');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
</script>
@endpush