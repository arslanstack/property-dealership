@extends('admin.admin_app')
@push('styles')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
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
        min-height: 100px;
    }

    .plus-icon {
        z-index: 99999;
        background-color: rgba(255, 244, 236, 0.88);
        cursor: pointer;
        position: absolute;
        bottom: 0;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        display: flex;
        justify-content: center;
        width: 40px;
        padding: 2px;
        height: 40px;
        align-items: center;
        border-radius: 50%;
    }

    .delete-icon {
        z-index: 99999;
        background-color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
        position: absolute;
        bottom: 0;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        display: flex;
        justify-content: center;
        width: 40px;
        padding: 2px;
        height: 40px;
        align-items: center;
        border-radius: 50%;
    }

    #add-more {
        border: 1px dashed #CE713EFF;
        cursor: pointer;
        border-radius: 5%;
    }

    .trash-icon {
        color: red;
    }

    .trash-icon:hover {
        color: gray;
    }

    .add-icon {
        color: #CE713EFF;
    }

    .add-icon:hover {
        color: gray;
    }
</style>
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Edit Neighborhood </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/neighborhoods') }}"> Neighborhoods </a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Edit Neighborhood </strong>
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
                    <form action="{{url('admin/neighborhoods/update')}}" class="m-4" id="neighborhood-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden value="{{$neighborhood->id}}" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="form-label"><strong>Title</strong></label>
                                    <input type="text" name="title" id="title-content" value="{{$neighborhood->title}}" required class="form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label"><strong>Banner Image</strong></label>
                                    <input type="file" name="banner" id="Bannerimage" class="form-control" accept="image/*">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label"><strong>Zip/Postal Code</strong></label>
                                    <input type="text" name="zip" required class="form-control" value="{{$neighborhood->zip}}">
                                </div>

                                <div class="form-group row">
                                    <label class="form-label"><strong>City/Town</strong></label>
                                    <input type="text" name="city" required value="{{$neighborhood->city}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="Bannerimage" style="cursor: pointer;" class="form-label float-right float-end">
                                    <div id="my-auto">
                                        <img id="imageView" src="{{asset('/uploads/neighborhoods/'. $neighborhood->banner)}}" class="img-fluid" style="width: 450px; height: 310px; overflow: contain;" alt="Image View">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label class="form-label"><strong>State/Province</strong></label>
                                    <input type="text" name="state" required value="{{$neighborhood->state}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row ml-1">
                                    <label class="form-label"><strong>Country</strong></label>
                                    <select name="country" required class="form-control" style="height: 2.22rem !important;" id="">
                                        @php
                                        $countries = country_select();
                                        @endphp

                                        @foreach($countries as $country)
                                        <option value="{{$country}}" {{$neighborhood->country == $country ? 'selected' : ''}}>{{$country}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="" class="form-label"><strong>Location (Select Latitude & Longitude Coordinates By Clicking The Map)</strong></label>
                                </div>
                                <div id="map" style="height: 100vh !important;"></div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label for="latitude" class="form-label"><strong>Latitude Coordinates</strong></label>
                                    <input type="text" name="latitude" id="latitude" class="form-control" value="{{$neighborhood->latitude}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mr-1">
                                    <label for="longitude" class="form-label"><strong>Longitude Coordinates</strong></label>
                                    <input type="text" name="longitude" id="longitude" class="form-control" value="{{$neighborhood->longitude}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="images" class="form-label"><strong>Images</strong></label>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row" id="showImgGal">
                                                @if(!empty($neighborhood->images))
                                                @foreach($neighborhood->images as $image)
                                                <div class="col-md-2 col-sm-6 my-2" id="img-gallery">
                                                    <img src="{{$image}}" class="img-fluid images-img" style="max-width: 100%; height: auto; overflow: contain; border-radius: 5%;" alt="Image View">
                                                    <div class="delete-icon" onclick="deleteImage(this)" data-url="{{$image}}" data-id="{{$neighborhood->id}}"><i class="fa fa-trash trash-icon"></i></div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropzone col-12" id="myDropzone"></div>
                                    <input type="text" name="images" id="images" hidden value="{{$images_array}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="description" class="form-label"><strong>Description</strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div id="loader" class="text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden"></span>
                                        </div>
                                    </div>
                                    <textarea class="form-control" id="description" name="description" hidden placeholder="Enter the Description" rows="10">{!! $neighborhood->description !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    images_array_string = $('#images').val();
    images_array = images_array_string ? JSON.parse(images_array_string) : [];
    console.log(images_array);
    let myDropzone = new Dropzone("#myDropzone", {
        url: "{{url('/admin/neighborhoods/imageManagement')}}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            if (response.status === 'success') {
                images_array.push(response.image_url);
                console.log(images_array);
                $('#images').val(JSON.stringify(images_array));
                console.log("input: " + $('#images').val());
                var img = document.createElement('img');
                img.src = response.image_url;
                img.className = 'img-fluid images-img';
                img.style = 'max-width: 100%; height: auto; overflow: contain; border-radius: 5%;';
                img.alt = 'Image View';
                var deleteIcon = document.createElement('div');
                deleteIcon.className = 'delete-icon';
                deleteIcon.onclick = function() {
                    deleteImage(this);
                };
                deleteIcon.setAttribute('data-url', response.image_url);
                deleteIcon.setAttribute('data-id', '{{$neighborhood->id}}');
                var icon = document.createElement('i');
                icon.className = 'fa fa-trash trash-icon';
                deleteIcon.appendChild(icon);
                var div = document.createElement('div');
                div.className = 'col-md-2 col-sm-6 my-2';
                div.id = 'img-gallery';
                div.appendChild(img);
                div.appendChild(deleteIcon);
                document.getElementById('showImgGal').appendChild(div);
                myDropzone.removeFile(file);
            } else {
                console.error('Error uploading images');
            }
        }
    });
</script>
<script>
    // on form submit i want to validate request 
    $('#neighborhood-form').submit(function() {
        // if images array is empty then show toastr
        if (images_array.length == 0) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.error("Please upload at least one image for gallery");
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
        latitude = Number($('#latitude').val());
        longitude = Number($('#longitude').val());
        const myLatlng = {
            lat: latitude,
            lng: longitude
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: myLatlng,
        });
        let infoWindow = new google.maps.InfoWindow({
            content: "Click the map to get Lat/Lng!",
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
                JSON.stringify(coordinates, null, 2),
            );
            infoWindow.open(map);
            $('#latitude').val(coordinates.lat);
            $('#longitude').val(coordinates.lng);
        });
    }

    initMap();
</script>
<script>
    function deleteImage(e) {
        var id = $(e).data('id');
        var url = $(e).data('url');
        $.ajax({
            url: "{{url('admin/neighborhoods/delete-image')}}",
            type: 'POST',
            data: {
                _token: "{{csrf_token()}}",
                url: url,
                id: id
            },
            success: function(data) {
                console.log(data);
                if (data.msg == 'success') {
                    $(e).parent().remove();
                    images_array = images_array.filter(image => image !== url);
                    $('#images').val(JSON.stringify(images_array));
                    console.log(images_array);
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    }
                    toastr.success(data.response);
                } else {
                    console.log(data);
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    }
                    toastr.error(data.response);
                }

            },
            error: function(data) {
                console.log(data);
                // show toastr
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                }
                toastr.error(data.response);
            }
        });
    }
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loader = document.getElementById('loader');
        CKEDITOR.ClassicEditor.create(document.getElementById("description"), {
            ckfinder: {},
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
                    'link', '|',
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
            minHeight: '100px',
            placeholder: 'Enter the Description',

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
            contentLanguageDirection: 'rtl',

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
        }).then(editor => {
            loader.style.display = 'none';
        }).catch(error => {
            console.error('Error initializing CKEditor:', error);
            loader.style.display = 'none';
        });
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
    var succession = "{{Session::has('success') ? 'true' : 'false'}}";
    if (succession == 'true') {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right"
        }
        toastr.success("{{Session::get('success')}}");

    }
    $('#Bannerimage').change(function() {
        $('#imageView').show();
        $('#imageView').attr('src', URL.createObjectURL(event.target.files[0]));
    });
</script>

@endpush