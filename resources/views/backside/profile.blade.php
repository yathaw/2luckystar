<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">Profile</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="list-group-navigation">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Account</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-4">
                                    <div class="list-group" role="tablist">
                                        <a class="list-group-item list-group-item-action active"
                                            id="list-home-list" data-bs-toggle="list" href="#list-home"
                                            role="tab">About</a>
                                        <a class="list-group-item list-group-item-action"
                                            id="list-profile-list" data-bs-toggle="list"
                                            href="#list-profile" role="tab">Setting</a>
                                        <a class="list-group-item list-group-item-action"
                                            id="list-messages-list" data-bs-toggle="list"
                                            href="#list-messages" role="tab">Change Profile</a>
                                        
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 mt-1">
                                    <div class="tab-content text-justify" id="nav-tabContent">
                                        <div class="tab-pane show active" id="list-home" role="tabpanel"
                                            aria-labelledby="list-home-list">
                                            <div class="avatar avatar-xl me-3">
                                                <img src="{{ asset($user->profile_photo_path) }}">
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="list-profile" role="tabpanel"
                                            aria-labelledby="list-profile-list">
                                            <form class="form form-horizontal" action="{{route('profile.update', $user->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="mmfont">နာမည်</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group has-icon-left">
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Name" id="first-name-icon" value="{{ $user->name }}" name="e_name">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-person"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="mmfont">အီးမေးလ်</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group has-icon-left">
                                                                <div class="position-relative">
                                                                    <input type="email" class="form-control"
                                                                        placeholder="Email" id="first-name-icon" value="{{ $user->email }}" name="e_email">
                                                                    <div class="form-control-icon">
                                                                        <i class="bi bi-envelope"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1 mmfont"> သိမ်းမည် </button>
                                                        </div>

                                                    </div>
                                                </div>
                                                

                                                
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="list-messages" role="tabpanel"
                                            aria-labelledby="list-messages-list">
                                            <form class="form form-horizontal" id="changepasswordForm">
                                                <div class="form-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-4">
                                                            <input type="file" class="image-preview-filepond" name="newprofile" id="newprofile">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('script_content')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
            
            FilePond.registerPlugin(
                // preview the image file type...
                FilePondPluginImagePreview
            );

            // Filepond: Image Preview
            var pond = FilePond.create( document.querySelector('.image-preview-filepond'), { 
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,
                stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleProgressIndicatorPosition: 'right bottom',
                styleButtonRemoveItemPosition: 'left bottom',
                styleButtonProcessItemPosition: 'right bottom',
  

                allowImagePreview: true, 
                allowImageFilter: false,
                allowImageExifOrientation: false,
                allowImageCrop: false,
                acceptedFileTypes: ['image/png','image/jpg','image/jpeg'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    // Do custom type detection here and return with promise
                    resolve(type);
                }),
                server: {
                    process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {

                        // fieldName is the name of the input field
                        // file is the actual file object to send
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);
                        var url = "{{ route('changeprofile') }}";
                        const request = new XMLHttpRequest();
                        request.open('POST', url);
                        var csrfToken = "{{ csrf_token() }}";

                        request.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        // Should call the progress method to update the progress to 100% before calling load
                        // Setting computable to false switches the loading indicator to infinite mode
                        request.upload.onprogress = (e) => {
                            progress(e.lengthComputable, e.loaded, e.total);
                        };

                        // Should call the load method when done and pass the returned server file id
                        // this server file id is then used later on when reverting or restoring a file
                        // so your server knows which file to return without exposing that info to the client
                        request.onload = function() {
                            if (request.status >= 200 && request.status < 300) {
                                // the load method accepts either a string (id) or an object
                                load(request.responseText);
                            }
                            else {
                                // Can call the error method if something is wrong, should exit after
                                error('oh no');
                            }
                        };


                        request.onreadystatechange = function() {
                            if (this.readyState == 4) {
                                if(this.status == 200) {
                                    let response = JSON.parse(this.responseText);
                                    
                                    if(response){
                                        location.reload();
                                    }
                                } else {
                                    Toastify({
                                        text: "Failed uploading to imgbb! see console f12",
                                        duration: 3000,
                                        close:true,
                                        gravity:"bottom",
                                        position: "right",
                                        backgroundColor: "#ff0000",
                                    }).showToast();   

                                    console.log("Error", this.statusText);
                                }
                            }
                        };

                        request.send(formData);
                        
                        // Should expose an abort method so the request can be cancelled
                        return {
                            abort: () => {
                                // This function is entered if the user has tapped the cancel button
                                request.abort();

                                // Let FilePond know the request has been cancelled
                                abort();
                            }
                        };
                    }
                }
                
            });


        

        document.addEventListener('FilePond:loaded', e => {
            console.log('FilePond ready for use', e.detail);
        });
    </script>

@stop
</x-backend>
