<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">Staff</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">Staff</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Staff List
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
                            <th class="mmfont">အီးမေးလ်</th>
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
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont" id="exampleModalCenterTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form>
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group hiddenPart">
                        <label for="name" class="mmfont"> Staff နာမည် </label>
                        <input type="text" class="form-control" id="name" name="name">

                        <span class="n_err_name error d-block text-danger"></span>

                    </div>
                    <div class="row form-group hiddenPart">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="email" class="mmfont"> အီးမေးလ် </label>
                            <input type="email" class="form-control" id="email" name="email">

                            <span class="n_err_email error d-block text-danger"></span>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label for="password" class="mmfont"> စကားဝှက် </label>
                            <input type="password" class="form-control" id="password" name="password">

                            <span class="n_err_password error d-block text-danger"></span>

                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label for="note" class="mmfont"> ခွင့်ပြုချက် </label>

                        <div class="form-group my-2 container">
                            <ul class="list-group list-group-horizontal row">
                                @foreach($permissions as $permission)

                                <li class="list-group-item col-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $permission->id }}" value="{{ $permission->id }}" name="permission[]" data-id="{{ $permission->id }}" checked="">
                                        <label class="form-check-label mmfont" for="inlineCheckbox{{ $permission->id }}"> {{ $permission->name }}
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                                
                            </ul>
                        </div>

                        <span class="n_err_note error d-block text-danger"></span>

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

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont" id="exampleModalCenterTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                <div class="modal-body">
                    <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
                        <a class="list-group-item list-group-item-action active mmfont"
                            id="list-sunday-list" data-bs-toggle="list" href="#list-sunday"
                            role="tab"> ပရိုဖိုင်းအချက်အလက် </a>
                        <a class="list-group-item list-group-item-action mmfont" id="list-monday-list"
                            data-bs-toggle="list" href="#list-monday" role="tab"> ခွင့်ပြုချက်စာရင်း </a>
                    </div>

                    <div class="tab-content text-justify">
                        <div class="tab-pane fade show active" id="list-sunday" role="tabpanel"
                            aria-labelledby="list-sunday-list">
                            <div class="row mt-3">
                                <h3 id="detail_username"></h3>
                                <p id="detail_email"> </p>
                                <p id="detail_role"> </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-monday" role="tabpanel" aria-labelledby="list-monday-list">
                            <div class="container">
                                <ul class="list-group list-group-horizontal row" id="permissionDiv"></ul>
                            </div>
                        </div>
                    </div>

                </div>
              
                <div class="modal-footer">
                    <button type="button" class="btn btn-light mmfont" data-bs-dismiss="modal">
                        <i class="bi bi-x btnicon"></i> ပိတ်မည် 
                    </button>
                </div>

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

            // READ
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getlistStaff') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
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
                        title: 'Staff List',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: [ 0, 1,2,3]
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
                                   '\r\n <h2> staff List </h2>'
                        },
                        messageBottom: ' 2 Lucky Stars <p> No.(14), Pon Nya Wuttana Street, Tamwe Tsp., Yangon. Tel: 095166021, 09785166021 </p>',
                        exportOptions: {
                            columns: [ 0, 1,2,3]
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
                $("#showModal").modal("show");
                
                $("form").attr('id', 'addForm');
                $("#exampleModalCenterTitle").text('Staff အသစ် ထည့်ရန် ');
            });

            // CREATE
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('staff.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {                        
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
                        
                        $('.n_err_email').remove();
                        $('#email').removeClass('border border-danger');

                        $('.n_err_password').remove();
                        $('#password').removeClass('border border-danger');

                        $('.n_err_role').remove();
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

                            if (key == "email") 
                            {
                                $('.n_err_email').html(err[key]);
                                $('#email').addClass('border border-danger');
                            }

                            if (key == "password") 
                            {
                                $('.n_err_password').html(err[key]);
                                $('#password').addClass('border border-danger');
                            }

                            if (key == "role") 
                            {
                                $('.n_err_role').html(err[key]);
                            }

                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });

            // Detail
            $('tbody').on('click', '.detailBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var role = $(this).data('role');

                // $('#rolename').val(name);

                $.ajax({
                    data: {id:id},
                    url: '/getPermission_byUserid',
                    type: "POST",
                    dataType: 'json',
                    success: function (data){
                        var Result='';

                        $.each(data,function (i,v) 
                        {
                            Result += `<li class="list-group-item col-4"> <small class="mmfont"> ${v.name} </small> </li>`;
                        });

                        $('#permissionDiv').html(Result);

                    }
                });

                $('#detail_username').html(name);
                $('#detail_email').html(email);
                $('#detail_role').html(role);


                $("#detailModal").modal("show");


            });

            // EDIT
            $('tbody').on('click', '.editBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#id').val(id);

                var title = `${name} အား ခွင့်ပြုချက်စာရင်း ပြင်ဆင်ရန်`;

                $(".modal-title").html(title); 

                $("form").attr('id', 'editForm');

                $('.hiddenPart').hide();
                $('.form-check-input').prop("checked", false);

                $.ajax({
                    data: {id:id},
                    url: '/getPermission_byUserid',
                    type: "POST",
                    dataType: 'json',
                    success: function (data){
                        var Result='';
                        // $('.form-check-input').removeAttr('checked');

                        $.each(data,function (i,v) 
                        {
                            $("#inlineCheckbox"+v.id).prop('checked', true);
                        });
                    }
                });


                $("#showModal").modal("show");
            });

            // UPDATE
            $("#showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#id').val();

                var permissionselected = [];
                $(':checkbox:checked').each(function() {
                    permissionselected.push($(this).attr('data-id'));
                });;
                
                var url="{{route('staff.update',':id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    data: {permission:permissionselected},
                    url: url,
                    type: "PUT",
                    dataType: 'json',
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

                    }
                });

                
            });

            // DELETE
            $('tbody').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('staff.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: "ထို staff ကို စာရင်းမှပယ်ဖျက်မည်!",
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
                            text: "ထို Staff အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ",
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
                            text: "ထို Staff အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။",
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