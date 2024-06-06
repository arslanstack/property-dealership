@extends('admin.admin_app')
@push('styles')
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
                                    <label class="form-label"><strong>Google Maps Link</strong> <a data-toggle="modal" data-target="#exampleModal" class="" style="color: red; text-decoration: underline;">Need Help?</a> </label>
                                    <input type="text" name="map" required class="form-control" value="{{$neighborhood->map}}">
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
                            <div class="col-md-4 pl-0">
                                <label class="form-label"><strong>City/Town</strong></label>
                                <input type="text" name="city" required value="{{$neighborhood->city}}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"><strong>State/Province</strong></label>
                                <input type="text" name="state" required value="{{$neighborhood->state}}" class="form-control">
                            </div>
                            <div class="col-md-4 pr-0">
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
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="images" class="form-label"><strong>Images</strong></label>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                @if(!empty($neighborhood->images))
                                                @foreach($neighborhood->images as $image)
                                                <div class="col-md-2 col-sm-6 my-2" id="img-gallery">
                                                    <img src="{{$image}}" class="img-fluid images-img" style="max-width: 100%; height: auto; overflow: contain; border-radius: 5%;" alt="Image View">
                                                    <!-- if more than one image then show delete icon else don't -->
                                                    @if(count($neighborhood->images) > 1)
                                                    <div class="delete-icon" onclick="deleteImage(this)" data-url="{{$image}}" data-id="{{$neighborhood->id}}"><i class="fa fa-trash trash-icon"></i></div>
                                                    @endif
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" name="images[]" {{empty($neighborhood->images) ? 'required' : ''}} id="image-gal-input" class="form-control" accept="image/*" multiple>
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
<div class="modal fade .bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><strong>How to add google maps location</strong></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-1">
                <img src="{{asset('assets/img/mapstut.gif')}}" style="width: 100%; height:auto; overflow:contain; margin:none;" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
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
                if (data.msg == 'success') {
                    $(e).parent().remove();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    }
                    toastr.success(data.response);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    }
                    toastr.error(data.response);
                }

            },
            error: function(data) {
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