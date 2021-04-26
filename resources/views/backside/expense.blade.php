<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont"> အသုံးစာရင်း</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page"> အသုံးစာရင်း</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <form>
                    <div class="row justify-content-center">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="sdate"> Start Date </label>
                                <input type="date" class="form-control" id="sdate" name="sdate">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label for="edate"> End Date </label>
                                <input type="date" class="form-control" id="edate" name="edate">
                            </div>
                        </div>

                        <div class="col-1">
                            <a href="javascript:void(0)" class="btn btn-light-primary d-none d-lg-block m-l-15 mt-4" id="searchBtn">
                                <i class="fas fa-search"></i> 
                            </a>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Expense List for <span class="text-success"> {{ $month }} </span>
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
                            <th class="mmfont">ရက်ဆွဲ</th>
                            <th class="mmfont">အမည်</th>
                            <th class="mmfont">ကုန်ကျစရိတ်အမျိုးအစား </th>
                            <th class="mmfont">ငွေပမာဏ</th>
                            <th class="mmfont">Status</th>
                            <th class="mmfont">တာ၀န်ခံအမည်</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="4"> 
                                <span class="tfoot_title mmfont float-end"> စုစုပေါင်း </span>
                            </th>
                            <th colspan="4"> 
                                <span class="tfoot_total text-danger"> </span>
                            </th>
                        </tr>
                    </tfoot>
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
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date" class="mmfont"> ရက်ဆွဲ </label>
                        <input type="date" class="form-control" id="date" name="date">

                        <span class="n_err_date error d-block text-danger"></span>

                    </div>

                    <div class="form-group">
                        <label for="name" class="mmfont">  အသုံးစာရင်းခေါင်းစဥ် </label>
                        <input type="text" class="form-control" id="name" name="name">

                        <span class="n_err_name error d-block text-danger"></span>

                    </div>

                    <div class="form-group">
                        <label for="amount" class="mmfont"> ငွေပမာဏ  </label>
                        <input type="number" class="form-control" id="amount" name="amount">

                        <span class="n_err_amount error d-block text-danger"></span>

                    </div>

                    <div class="form-group">
                        <label for="expensetype" class="mmfont"> ကုန်ကျစရိတ်အမျိုးအစား </label>
                        <select placeholder="Choose Brand" data-allow-clear="1" class="form-control" id="expensetype" name="expensetype">
                            @foreach($expensetypes as $expensetype)
                            <option value="{{ $expensetype->id }}"> 
                                {{ $expensetype->name }}
                            </option>
                            @endforeach
                        </select>
                         
                        <span class="n_err_expensetype error d-block text-danger"></span>
                    </div>

                    <div class="form-group my-3">
                        <label for="date" class="mmfont d-block"> Type : </label>
                            <div class="d-inline-block me-2 mb-1">
                            
                                <div class="form-check">
                                    <div class="check">
                                        <input type="radio" id="typeone" class="form-check-input"
                                            checked name="status" value="Paid">
                                        <label for="typeone"> ပေးဆောင်ပြီးပါပြီ </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-inline-block me-2 mb-1">

                            <div class="form-check">
                                <div class="checkbox">
                                    <input type="radio" id="typetwo" class="form-check-input" name="status" value="Debit">
                                    <label for="typetwo"> အကြွေး </label>
                                </div>
                            </div>
                        </div>

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
        var expensetypeChoice;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            getTotalamount();

            function getTotalamount()
            {
                $.ajax({
                    type:'GET',
                    url: "{{ route('getmomentTotal')}}",
                    success: (data) => {   
                        // console.log(data);                     
                        $('.tfoot_total').html(data.total);
                    }
                });
            }

            expensetypeChoice = new Choices('#expensetype', {
               delimiter: ',',
               editItems: true,
               maxItemCount: 5,
               removeItemButton: true,
            });

            // SEARCH
            $('#searchBtn').click(function(){
                var sdate = $('#sdate').val();
                var edate = $('#edate').val();

                $('.card-title').html('Search Expense For '+sdate+' - '+edate);



                var url="{{route('searchExpense')}}";

                $.ajax({
                    data: {sdate:sdate, edate:edate},
                    url: '{{ route('searchExpensetotal') }}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data){
                        console.log(data.searchTotal);
                        $('.tfoot_total').html(data.searchTotal);


                    }
                });

                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    'ajax': {
                        'data': {sdate:sdate, edate:edate},
                        'url' : url,
                        type: "POST",
                        dataType: 'json',
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'expensedate', name: 'expensedate'},
                        {data: 'title', name: 'title'},
                        {data: 'expensetype', name: 'expensetype'},

                        {data: 'amount', name: 'amount'},
                        {data: 'estatus', name: 'estatus'},

                        {data: 'user', name: 'user'},

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
                            title: 'Expense For '+sdate+' - '+edate,
                            pageSize: 'A4',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3]
                            },
                            footer: true,

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
                                       '\r\n <h2> Expense For '+sdate+' - '+edate+'</h2>'
                            },
                            messageBottom: ' 2 Lucky Stars <p> No.(14), Pon Nya Wuttana Street, Tamwe Tsp., Yangon. Tel: 095166021, 09785166021 </p>',
                            
                            exportOptions: {
                                columns: [ 0, 1, 2, 3]
                            },
                            footer: true,
                            customize: function ( print ){        
                                // $(print.pdfument.body)
                                // .css( 'font-size', '10pt' )
                                // .prepend(
                                //     '<img src="{{ asset('icon.png') }}" style="position:absolute; top:0; left:0;" />'
                                // );     

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
                

                
            });

            // READ
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getlistExpenses') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'expensedate', name: 'expensedate'},
                    {data: 'title', name: 'title'},
                    {data: 'expensetype', name: 'expensetype'},

                    {data: 'amount', name: 'amount'},
                    {data: 'estatus', name: 'estatus'},


                    {data: 'user', name: 'user'},

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
                        title: 'expense List',
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
                                   '\r\n <h2> expense List </h2>'
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
                $("#exampleModalCenterTitle").text(' အသုံးစာရင်း အသစ် ထည့်ရန် ');
            });

            // CREATE
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('expense.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: " အသုံးစာရင်း အချက်အလက်များ အောင်မြင်စွာသိမ်းဆည်းပြီးပါပြီ",
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

                $(".modal-title").html('Create New expense'); 

                $('.n_err_name').remove();
                $('#name').removeClass('border border-danger');
            });

            // EDIT
            $('tbody').on('click', '.editBtn', function (){

                var id = $(this).data('id');
                var title = $(this).data('title');
                var expensedate = $(this).data('expensedate');
                var amount = $(this).data('amount');
                var status = $(this).data('status');
                var expensetype_id = $(this).data('expensetype_id');

                console.log(title);

                $('#id').val(id);
                $('#name').val(title);
                $('#amount').val(amount);
                $('#date').val(expensedate);
                $('input:radio[name=status][value='+status+']').attr('checked', true);

                expensetypeChoice.setChoiceByValue(expensetype_id.toString());


                $("form").attr('id', 'editForm');

                $("#exampleModalCenterTitle").text(' အသုံးစာရင်း ပြင်ဆင် ရန် ');

                $("#showModal").modal("show");
            });

            // UPDATE
            $("#showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#id').val();
                var title = $('#name').val();
                var amount = $('#amount').val();
                var date = $('#date').val();
                var status = $('input[name="status"]:checked').val();
                var expensetypeid = $('#expensetype').val();


                
                var url="{{route('expense.update',':id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    data: {title:title, amount:amount, date:date, status:status, expensetypeid:expensetypeid},
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
                
                var url="{{route('expense.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: "ထို အသုံးစာရင်းကို စာရင်းမှပယ်ဖျက်မည်!",
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
                            text: "ထို အသုံးစာရင်း အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ",
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
                            text: "ထို အသုံးစာရင်း အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။",
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