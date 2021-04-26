<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">ထုတ်လုပ်သည့်နိုင်ငံ</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">ထုတ်လုပ်သည့်နိုင်ငံ</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Made-In List
                <button type="button" class="btn btn-primary float-end createBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="အသစ်ထည့်မည်">
                    <i class="bi bi-plus btnicon"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-light-success alert-dismissible show fade d-none">
                            <span class="mmfont"> အောင်မြင်စွာသိမ်းဆည်းပြီးပါပြီ </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th class="mmfont">နံပါတ်စဥ်</th>
                            <th class="mmfont">အမည်</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </section>

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
                <input type="hidden" name="oldimage" id="oldimage">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="mmfont"> ထုတ်လုပ်သည့်နိုင်ငံ </label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">

                        <span class="n_err_name error d-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="flag" class="mmfont mb-3"> ထုတ်လုပ်သည့်နိုင်ငံအလံ </label>

                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="image" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url({{ asset('assets/preview.png') }});">
                                </div>
                            </div>
                        </div>
                        <span class="n_err_flag error d-block text-danger"></span>
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


@section('script_content')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imageUpload").change(function() {
                readURL(this);
            });

            // READ
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getlistCountries') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                destroy:true,
                language: {
                   oPaginate: {
                        sNext: '<i class="bi bi-skip-end"></i>',
                        sPrevious: '<i class="bi bi-skip-start"></i>',
                        sFirst: '<i class="fa fa-skip-backward"></i>',
                        sLast: '<i class="fa fa-skip-forward"></i>'
                    }
                } ,

                dom: 'Bfrtip',
                buttons: [
                    
                    {
                        extend: 'pdfHtml5',
                        title: 'Made-In List',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: [ 0, 1]
                        },
                        customize: function ( pdf ){

                            pdf.content[1].table.widths = Array(pdf.content[1].table.body[0].length + 1).join('*').split('');

                            //Create a date string that we use in the footer. Format is dd-mm-yyyy
                            var now = new Date();
                            var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();

                            pdf['header']=(function() {
                                return {
                                    columns: [
                                        {
                                            alignment: 'left',
                                            text: '2 Lucky Stars',
                                            fontSize: 9,
                                        },
                                        {
                                            alignment: 'right',
                                            fontSize: 7,
                                            text: 'No.(14), Pon Nya Wuttana Street, Tamwe Tsp., Yangon. Tel: 095166021, 09785166021'
                                        }
                                    ],
                                    margin: 20
                                }
                            });

                            pdf['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        {
                                            alignment: 'left',
                                            text: ['Created on: ', { text: jsDate.toString() }]
                                        },
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                        }
                                    ],
                                    margin: 20
                                }
                            });

                        }
                    },

                    {
                        extend: 'print',
                        title: '2 Lucky Stars',
                        messageTop: function() {
                            return '\r\n <p style="text-align:center"> No.(14), Pon Nya Wuttana Street, Tamwe Tsp., Yangon. Tel: 095166021, 09785166021 </p>' +
                                   '\r\n <h2> country List </h2>'
                        },
                        messageBottom: ' 2 Lucky Stars <p> No.(14), Pon Nya Wuttana Street, Tamwe Tsp., Yangon. Tel: 095166021, 09785166021 </p>',
                        exportOptions: {
                            columns: [ 0, 1]
                        },
                        customize: function ( print ){

                            $(print.document.body).find('h1').css('text-align', 'center');

                            // $('tfoot tr th').attr('colspan',2);
                            $('row c[r*="10"]', print).attr( 's', '25' );
                        }
                    },
                ]
            });
    
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-outline-info mr-1');

            $('.buttons-print').find('span').html('<i class="bi bi-printer"></i> Print ');
            $('.buttons-pdf').find('span').html('<i class="bi bi-file-earmark-ppt"></i> PDF ');

            $('.createBtn').on('click', function(){
                $('.hiddenPart').hide();
                $("#showModal").modal("show");
                
                $("form").attr('id', 'addForm');
                $("#exampleModalCenterTitle").text('ထုတ်လုပ်သည့်နိုင်ငံ အသစ် ထည့်ရန် ');
            });

            // CREATE
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('country.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: "ထုတ်လုပ်သည့်နိုင်ငံ အချက်အလက်များ အောင်မြင်စွာသိမ်းဆည်းပြီးပါပြီ",
                            buttons: false,
                            timer : 1500
                        });

                        $("#showModal").modal("hide");

                        $('#addForm').trigger("reset");
                        table.draw();

                        $('.alert').removeClass('d-none');
                        $('.msg').html(data.success);

                        $(".alert").fadeOut(3000, function() {
                            $(this).addClass("d-none");
                            $(this).fadeIn();
                        });

                        $('.n_err_name').remove();
                        $('#name').removeClass('border border-danger');
                        

                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "name") 
                            {
                                $('.n_err_name').html(err[key]);
                                $('#name').addClass('border border-danger');
                            }

                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });

            $("#showModal").on('click','.btnclose',function(e){
                $('form').trigger("reset");

                $(".modal-title").html('Create New country'); 

                $('.n_err_name').remove();
                $('#name').removeClass('border border-danger');
            });

            // EDIT
            $('tbody').on('click', '.editBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');
                var image = $(this).data('image');


                $('#id').val(id);
                $('#name').val(name);
                $('#oldimage').val(image);

                $('#imagePreview').css('background-image', 'url('+image+')');


                $(".modal-title").html('Edit Existing Category'); 

                $("form").attr('id', 'editForm');

                $("#exampleModalCenterTitle").text('ထုတ်လုပ်သည့်နိုင်ငံ ပြင်ဆင် ရန် ');

                $('.hiddenPart').show();

                $("#showModal").modal("show");
            });

            // UPDATE
            $("#showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#id').val();
                var name = $('#name').val();
                
                var url="{{route('country.update',':id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    type:'POST',
                    dataType: 'json',
                    url: url,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data){

                        $('#editForm').trigger("reset");
                        table.draw();

                        $("#showModal").modal("hide");

                        $('.alert').removeClass('d-none');
                        $('.msg').html(data.success);

                        $(".alert").fadeOut(3000, function() {
                            $(this).addClass("d-none");
                            $(this).fadeIn();

                        });

                    },
                    error: function(error){
                        console.log(error.responseJSON.errors);
                    }
                });

                
            });

            // DELETE
            $('tbody').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('country.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: "ထိုထုတ်လုပ်သည့်နိုင်ငံကို စာရင်းမှပယ်ဖျက်မည်!",
                icon: "warning",
                showCancelButton:true,
                closeOnConfirm : false,
                closeOnCancel : false,
                buttons: true,
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        Swal.fire({
                            icon: "success",
                            text: "ထိုထုတ်လုပ်သည့်နိုင်ငံ အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ",
                            buttons: false,
                            timer : 1500
                        }).then(
                            function()
                            {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    success: function (data) {
                                        table.draw();

                                        $('.alert').removeClass('d-none');
                                        $('.msg').html(data.success);

                                        $(".alert").fadeOut(3000, function() {
                                            $(this).addClass("d-none");
                                            $(this).fadeIn();

                                        });
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });
                            }
                        );
                        
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: "ထိုထုတ်လုပ်သည့်နိုင်ငံ အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။",
                            buttons: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

        });
    </script>

@stop
</x-backend>