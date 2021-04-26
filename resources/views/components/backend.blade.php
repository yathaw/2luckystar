<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> 2 Luckystars </title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/icon.jpg') }}" type="image/x-icon">

    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatable/buttons.dataTables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/yearpicker/yearpicker.css') }}">

    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/quill/quill.snow.css') }}">

    <!-- Multiple Image Upload & Preview CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/multipleimageupload/image-uploader.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/wizard/steps.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/owlcarousel2/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owlcarousel2/owlcarousel/assets/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{asset('assets/vendors/toastify/toastify.css')}}">

    <!-- Filepond -->

    <link href="{{ asset('assets/vendors/filepond/filepond.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="{{ route('dashboard') }}" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item  has-sub {{ Request::segment(1) === 'profile' ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span class="mmfont"> {{ Auth::user()->name }} </span>
                            </a>
                            <ul class="submenu {{ Request::segment(1) === 'profile' ? 'active' : '' }}">
                                <li class="submenu-item {{ Request::segment(1) === 'profile' ? 'active' : '' }}">
                                    <a href="{{ route('profile.index') }}" class="mmfont"> မိမိအကောင့် </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="javascript:void(0)" class="mmfont changepasswordBtn"> စကားဝှက်ကိုပြောင်းရန်</a>
                                </li>
                                
                                <li class="submenu-item ">
                                    <a href="javascript:void(0)" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="mmfont"> ထွက်ရန်
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title mmfont">မာဓိကာ</li>

                        <li class="sidebar-item {{ Request::segment(1) === 'dashboard' ? 'active' : '' }} ">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span class="mmfont">ပင်မစာမျက်နှာ</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{ Request::segment(1) === 'report' ? 'active' : '' }}">
                            <a href="{{ route('report.index') }}" class='sidebar-link'>
                                <i class="bi bi-graph-up"></i>
                                <span class="mmfont">အရောင်းအ၀ယ်စာရင်း</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) === 'expense' ? 'active' : '' }}">
                            <a href="{{ route('expense.index') }}" class='sidebar-link'>
                                <i class="bi bi-wallet2"></i>
                                <span class="mmfont">အသုံးစာရင်း</span>
                            </a>
                        </li>

                        <li class="sidebar-title mmfont">ကုန်ပစ္စည်း</li>

                        <li class="sidebar-item {{ Request::segment(1) === 'sale' ? 'active' : '' }}">
                            <a href="{{ route('sale.index') }}" class='sidebar-link'>
                                <i class="bi bi-cart-fill"></i>
                                <span class="mmfont">စျေးရောင်းမည်</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) === 'item' ? 'active' : '' }}">
                            <a href="{{ route('item.index') }}" class='sidebar-link'>
                                <i class="bi bi-basket2-fill"></i>
                                <span class="mmfont"> ကားပစ္စည်း </span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) === 'spa' ? 'active' : '' }}">
                            <a href="{{ route('spa.index') }}" class='sidebar-link'>
                                <i class="bi bi-bucket-fill"></i>
                                <span>SPA</span>
                            </a>
                        </li>

                        <li class="sidebar-title">People</li>

                        <li class="sidebar-item {{ Request::segment(1) === 'staff' ? 'active' : '' }}">
                            <a href="{{ route('staff.index') }}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span> Staff </span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) === 'supplier' ? 'active' : '' }} ">
                            <a href="{{ route('supplier.index') }}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span> Supplier </span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) === 'customer' ? 'active' : '' }} ">
                            <a href="{{ route('customer.index') }}" class='sidebar-link'>
                                <i class="bi bi-person-check-fill"></i>
                                <span> Customer </span>
                            </a>
                        </li>                        

                        <li class="sidebar-title mmfont">အပိုစာမျက်နှာများ</li>

                        <li class="sidebar-item  {{ Request::segment(1) === 'car' ? 'active' : '' }} ">
                            <a href="{{ route('car.index') }}" class='sidebar-link'>
                                <i class="bi bi-tags-fill"></i>
                                <span class="mmfont"> ကားအမျိုးအစား </span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) === 'country' ? 'active' : '' }} ">
                            <a href="{{ route('country.index') }}" class='sidebar-link'>
                                <i class="bi bi-globe2"></i>
                                <span class="mmfont">ထုတ်လုပ်သည့်နိုင်ငံ</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{ Request::segment(1) === 'category' ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span class="mmfont"> ပစ္စည်းအမျိုးအစား </span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::segment(1) === 'brand' ? 'active' : '' }}">
                            <a href="{{ route('brand.index') }}" class='sidebar-link'>
                                <i class="bi bi-award-fill"></i>
                                <span class="mmfont"> ကားအမှတ်တံဆိပ် </span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{ Request::segment(1) === 'color' ? 'active' : '' }}">
                            <a href="{{ route('color.index') }}" class='sidebar-link'>
                                <i class="bi bi-palette-fill"></i>
                                <span class="mmfont"> အရောင် </span>
                            </a>
                        </li>
                        

                        

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                
                {{ $slot }}
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end text-center">
                        <p> Built <span class="text-danger">
                            <i class="bi bi-heart"></i></span> by <a href="http://yathawmyatnoe.tech/" target="_blank"> YTMN </a>
                        </p>
                        <p>Contact me on the different platforms and social networks</p>

                        <a class="footer-social-link" href="https://codepen.io/franko1987" target="__blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M8.21 12L6.88 12.89V11.11L8.21 12M11.47 9.82V7.34L7.31 10.12L9.16 11.36L11.47 9.82M16.7 10.12L12.53 7.34V9.82L14.84 11.36L16.7 10.12M7.31 13.88L11.47 16.66V14.18L9.16 12.64L7.31 13.88M12.53 14.18V16.66L16.7 13.88L14.84 12.64L12.53 14.18M12 10.74L10.12 12L12 13.26L13.88 12L12 10.74M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12M18.18 10.12C18.18 10.09 18.18 10.07 18.18 10.05L18.17 10L18.17 10L18.16 9.95C18.15 9.94 18.15 9.93 18.14 9.91L18.13 9.89L18.11 9.85L18.1 9.83L18.08 9.8L18.06 9.77L18.03 9.74L18 9.72L18 9.7L17.96 9.68L17.95 9.67L12.3 5.91C12.12 5.79 11.89 5.79 11.71 5.91L6.05 9.67L6.05 9.68L6 9.7C6 9.71 6 9.72 6 9.72L5.97 9.74L5.94 9.77L5.93 9.8L5.9 9.83L5.89 9.85L5.87 9.89L5.86 9.91L5.84 9.95L5.84 10L5.83 10L5.82 10.05C5.82 10.07 5.82 10.09 5.82 10.12V13.88C5.82 13.91 5.82 13.93 5.82 13.95L5.83 14L5.84 14L5.84 14.05C5.85 14.06 5.85 14.07 5.86 14.09L5.87 14.11L5.89 14.15L5.9 14.17L5.92 14.2L5.94 14.23C5.95 14.24 5.96 14.25 5.97 14.26L6 14.28L6 14.3L6.04 14.32L6.05 14.33L11.71 18.1C11.79 18.16 11.9 18.18 12 18.18C12.1 18.18 12.21 18.15 12.3 18.1L17.95 14.33L17.96 14.32L18 14.3L18 14.28L18.03 14.26L18.06 14.23L18.08 14.2L18.1 14.17L18.11 14.15L18.13 14.11L18.14 14.09L18.16 14.05L18.16 14L18.17 14L18.18 13.95C18.18 13.93 18.18 13.91 18.18 13.88V10.12M17.12 12.89V11.11L15.79 12L17.12 12.89Z"></path>
                            </svg>
                        </a>

                        <a class="footer-social-link" href="https://github.com/yathaw" target="__blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"></path>
                            </svg>
                        </a>

                        <a class="footer-social-link" href="https://twitter.com/frankisdray" target="__blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"></path>
                            </svg>
                        </a>

                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mmfont" id="exampleModalCenterTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form>
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="password" class="mmfont"> စကားဝှက် </label>
                            <input type="password" class="form-control" id="password" name="password">

                            <span class="n_err_password error d-block text-danger"></span>

                        </div>

                    </div>
                  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light mmfont" data-bs-dismiss="modal">
                            <i class="bi bi-x btnicon"></i> ပိတ်မည် 
                        </button>
                        <button type="submit" class="btn btn-primary mmfont">
                            <i class="bi bi-save-fill btnicon"></i> သိမ်းမည်
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Datatable JS -->
    <script src="{{ asset('assets/vendors/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatable/buttons.colVis.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/extensions/sweetalert2.js') }}"></script> --}}
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/yearpicker/yearpicker.js') }}"></script>

    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/quill/quill.min.js') }}"></script>

    <!-- Multiple Image Upload & Preview JS -->
    <script src="{{ asset('assets/vendors/multipleimageupload/image-uploader.min.js') }}"></script>

    {{-- Wizard --}}

    <script src="{{ asset('assets/vendors/wizard/jquery.steps.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendors/wizard/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wizard/steps.js') }}"></script> --}}

    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/vendors/owlcarousel2/owlcarousel/owl.carousel.js') }}"></script>

    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    
    <script src="{{ asset('assets/vendors/filepond/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{asset('assets/vendors/toastify/toastify.js')}}"></script>


    <script src="{{ asset('assets/vendors/filepond/filepond.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('table').on('draw.dt', function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            })


            $("[data-bs-toggle=popover]").popover();
            $('[data-bs-toggle="tooltip"]').tooltip();

            $('.changepasswordBtn').on('click', function(){
                $("#showModal").modal("show");
                
                $("form").attr('id', 'addForm');
                $("#exampleModalCenterTitle").text('စကားဝှက် အသစ် ပြောင်းရန် ');
            });  

            // CREATE
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('changepassword')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        window.location.href="{{ route('login') }}";

                        $(".alert").fadeOut(3000, function() {
                            $(this).addClass("d-none");
                            $(this).fadeIn();
                        });

                        $('.n_err_password').remove();
                        $('#password').removeClass('border border-danger');

                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "password") 
                            {
                                $('.n_err_password').html(err[key]);
                                $('#password').addClass('border border-danger');
                            }

                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });          
        });

    </script>
    @yield("script_content")
</body>

</html>