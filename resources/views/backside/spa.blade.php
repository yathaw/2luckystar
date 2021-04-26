<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">SPA </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">SPA </li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                SPA List
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
                            <th class="mmfont">ကုဒ်နံပါတ်​</th>
                            <th class="mmfont">အမည်</th>
                            <th class="mmfont">စျေးနှုန်း</th>

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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont" id="exampleModalCenterTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form>
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="mmfont"> SPA အမည် </label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">

                        <span class="n_err_name error d-block text-danger"></span>

                    </div>

                    <div class="form-group">
                        <label for="price" class="mmfont"> စျေးနှုန်း </label>
                        <input type="text" class="form-control" id="price" aria-describedby="emailHelp" name="price">

                        <span class="n_err_price error d-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="price" class="mmfont"> အသေးစိတ်ဖော်ပြချက် </label>
                        <textarea class="form-control d-none" id="hiddenArea" name="description"></textarea>
                        <div id="full"></div>

                        <span class="n_err_description error d-block text-danger"></span>

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

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTitle">  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            

            <div class="modal-body">
                <h3 id="d_name"></h3>

                <h5 id="d_price" class="text-danger"></h5>
                
                <p id="d_description" class="mmfont"></p>

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

            var quill = new Quill("#full", { 
            bounds: "#full-container .editor", 
            modules: { 
                toolbar: [
                    [{ font: [] }, { size: [] }], 
                    ["bold", "italic", "underline", "strike"], 
                    [
                        { color: [] }, 
                        { background: [] }
                    ], 
                    [
                        { script: "super" }, 
                        { script: "sub" }
                    ], 
                    [
                        { list: "ordered" }, 
                        { list: "bullet" }, 
                        { indent: "-1" }, 
                        { indent: "+1" }
                    ], 
                    ["direction", { align: [] }], 
                    ["link", "image", "video"], 
                    ["clean"]] 
                }, 
                theme: "snow" 
            })

            // READ
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getlistSpas') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'codeno', name: 'codeno'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
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
                        title: 'SPA List',
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
                                   '\r\n <h2> spa List </h2>'
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
                $("#showModal").modal("show");
                
                $("form").attr('id', 'addForm');
                $("#exampleModalCenterTitle").text('SPA  အသစ် ထည့်ရန် ');
            });

            // CREATE
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                

                var about = document.querySelector('textarea[name=description]');

                var quillData = quill.getContents();
                var quillText = quill.getText();
                var quillHtml = quill.root.innerHTML.trim();

                about.value =  quillHtml;


                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('spa.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: "SPA  အချက်အလက်များ အောင်မြင်စွာသိမ်းဆည်းပြီးပါပြီ",
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


                        $('.n_err_price').remove();
                        $('#price').removeClass('border border-danger');                        

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

                            if (key == "price") 
                            {
                                $('.n_err_price').html(err[key]);
                                $('#price').addClass('border border-danger');
                            }

                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });

            $("#showModal").on('click','.btnclose',function(e){
                $('form').trigger("reset");

                $(".modal-title").html('Create New spa'); 

                $('.n_err_name').remove();
                $('#name').removeClass('border border-danger');
            });

            // DETAIL
            $('tbody').on('click', '.detailBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var codeno = $(this).data('codeno');
                var description = $(this).data('description');

                $('#d_name').html(name);

                $('#d_price').html(price);

                $('#d_description').html(description);


                $("#detailTitle").html('Detail For '+codeno); 

                $("#detailModal").modal("show");
            });

            // EDIT
            $('tbody').on('click', '.editBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                var description = $(this).data('description');

                quill.clipboard.dangerouslyPasteHTML(`${description}`);


                $('#id').val(id);
                $('#name').val(name);
                $('#price').val(price);


                $(".modal-title").html('Edit Existing Category'); 

                $("form").attr('id', 'editForm');

                $("#exampleModalCenterTitle").text('SPA  ပြင်ဆင် ရန် ');

                $("#showModal").modal("show");
            });

            // UPDATE
            $("#showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#id').val();
                var name = $('#name').val();
                var price = $('#price').val();

                var about = document.querySelector('textarea[name=description]');

                var quillData = quill.getContents();
                var quillText = quill.getText();
                var quillHtml = quill.root.innerHTML.trim();

                about.value =  quillHtml;

                var description = $('#hiddenArea').val();


                
                var url="{{route('spa.update',':id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    data: {name:name, price:price, description:description},
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

                    },
                    error: function(error){
                        console.log(error.responseJSON.errors);
                    }
                });

                
            });

            // DELETE
            $('tbody').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('spa.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: "ထိုSPA ကို စာရင်းမှပယ်ဖျက်မည်!",
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
                            text: "ထို SPA  အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ",
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
                            text: "ထို SPA  အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။",
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