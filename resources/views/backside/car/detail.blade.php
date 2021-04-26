<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">ကားပစ္စည်း</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">ကားပစ္စည်း</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="d-inline-block"> #{{ $item->codeno }} </h4>

                

                <a href="{{ route('item.edit', $item->id) }}" class="btn btn-warning float-end mx-2 text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်">
                    <i class="bi bi-gear btnicon"></i>
                </a>

                <a href="javascript:void(0)" class="btn btn-primary float-end stockBtn mx-2 " data-bs-toggle="tooltip" data-bs-placement="top" title="Stock ထပ်ထည့်မည်" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                    <i class="bi bi-bag-plus-fill btnicon"></i>
                </a>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        @php
                            $images = json_decode($item->photo);

                            $stockqtys = $item->stocks;
                            $stock = 0;
                            foreach ($stockqtys as $stockqty) {
                                $stock += $stockqty->qty;
                            }


                            $saleqtys = $item->saledetails;
                            $sale = 0;
                            foreach ($saleqtys as $saleqty) {
                                $sale += $saleqty->qty;
                            }

                            $currentstock = $stock - $sale;

                        @endphp

                        @if(isset($images))

                            @if(isset($images[1]))
                                <div class="owl-carousel owl-theme">
                                    @foreach($images as $image)

                                    <div class="item">
                                        <img src="{{ asset($image) }}" alt="">
                                    </div>
                                    @endforeach

                                            
                                </div>
                            @else
                                <img src="{{ asset($images[0]) }}" class="img-fluid">
                                
                            @endif    
                        @else
                            <img src="{{ asset('assets/preview.png') }}" class="img-fluid">
                        @endif
                    </div>

                    <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                        <h3> {{ $item->name }} </h3>

                        <p> <span class="mmfont"> ကားအမျိုးအစား </span> : 
                            {{ $item->car->brand->name }} ( {{ $item->car->name }} )
                        </p>
                        <p> <span class="mmfont"> ပစ္စည်းအမျိုးအစား </span> : {{ $item->category->name }} </p>
                        <p> <span class="mmfont"> ထုတ်လုပ်သည့်နိုင်ငံ </span> : {{ $item->country->name }} </p>

                        <p> <span class="mmfont"> အရောင် </span> : <div style="width:50px; height:50px; background-color:{{ $item->color->code }}"> </div> {{ $item->color->name }} </p>

                        <p> <span class="mmfont"> လက်ကျန်စာရင်း </span> : <span class="text-danger fs-3"> {{ $currentstock }} </span> ခု </p>


                    </div>


                    <div class="col-12">
                        <p> {!! $item->description !!} </p>

                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="d-inline-block"> Stock List </h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th class="mmfont">နံပါတ်စဥ်</th>
                            <th class="mmfont">Stock ထည့်သည့်ရက်စွဲ </th>
                            <th class="mmfont">Supplier</th>
                            <th class="mmfont">အရေအတွက်</th>
                            <th class="mmfont"> PC / CN</th>
                            <th class="mmfont">၀ယ်စျေး</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </section>

<!-- Add Stock Modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont" id="exampleModalCenterTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date" class="mmfont"> Stock ၀င်သည့်ရက်ဆွဲ </label>
                        <input type="date" class="form-control" id="date" name="date">

                        <span class="n_err_name error d-block text-danger"></span>

                    </div>

                    <div class="row form-group my-3">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <label for="price" class="mmfont"> ၀ယ်စျေး</label>
                            <input type="number" class="form-control" id="price" name="price">

                            <span class="n_err_wholesale error d-block text-danger"></span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <label for="qty" class="mmfont"> အရေအတွက် </label>
                            <input type="number" class="form-control" id="qty" name="qty">

                            <span class="n_err_qty error d-block text-danger"></span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <label for="pc" class="mmfont"> PC / CN : </label>
                            <input type="number" class="form-control" id="pc" name="pc">

                            <span class="n_err_pc error d-block text-danger"></span>
                        </div>

                    </div>

                    <div class="form-group my-3">
                        <label for="date" class="mmfont d-block"> Type : </label>
                            <div class="d-inline-block me-2 mb-1">
                            
                                <div class="form-check">
                                    <div class="check">
                                        <input type="radio" id="typeone" class="form-check-input"
                                            checked name="type" value="Supplier">
                                        <label for="typeone"> Supplier </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-inline-block me-2 mb-1">

                            <div class="form-check">
                                <div class="checkbox">
                                    <input type="radio" id="typetwo" class="form-check-input" name="type" value="Market">
                                    <label for="typetwo">Market</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">New Supplier</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                        role="tab" aria-controls="profile" aria-selected="false">Old Supplier</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row mt-3">

                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="form-group my-3 my-3">
                                                <label for="sup_name" class="mmfont"> နာမည် </label>
                                                <input type="text" class="form-control" id="sup_name" name="sup_name" >
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="form-group my-3 my-3">
                                                <label for="sup_phone" class="mmfont"> ဖုန်းနံပါတ် </label>
                                                <input type="text" class="form-control" id="sup_phone" name="sup_phone">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="form-group my-3 my-3">
                                                <label for="sup_address" class="mmfont"> လိပ်စာ </label>
                                                <input type="text" class="form-control" id="sup_address" name="sup_address">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group my-3 my-3">
                                                <label for="sup_note"> Note </label>
                                                <textarea class="form-control" name="sup_note" id="sup_note" rows="6"></textarea>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group my-3 my-3">
                                                <label for="sup_existingsupplier"> Existing Supplier </label>
                                                <select placeholder="Choose Existing Supplier" data-allow-clear="1" class="form-control supplierchoice " id="sup_existingsupplier" name="sup_existingsupplier">
                                                    @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}"> 
                                                        {{ $supplier->name }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
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

<!-- Edit Stock Modal -->
<div class="modal fade" id="editstockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mmfont"> Edit Stock For {{ $item->name }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form>
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="e_date" class="mmfont"> Stock ၀င်သည့်ရက်ဆွဲ </label>
                        <input type="date" class="form-control" id="e_date" name="date">

                        <span class="n_err_name error d-block text-danger"></span>

                    </div>

                    <div class="row form-group my-3">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <label for="e_price" class="mmfont"> ၀ယ်စျေး</label>
                            <input type="number" class="form-control" id="e_price" name="price">

                            <span class="n_err_wholesale error d-block text-danger"></span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <label for="e_qty" class="mmfont"> အရေအတွက် </label>
                            <input type="number" class="form-control" id="e_qty" name="qty">

                            <span class="n_err_qty error d-block text-danger"></span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <label for="e_pc" class="mmfont"> PC / CN : </label>
                            <input type="number" class="form-control" id="e_pc" name="pc">

                            <span class="n_err_pc error d-block text-danger"></span>
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
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = {{ $item->id }};
                
            var url="{{url('getitemStocks/:id')}}";
            url=url.replace(':id',id);

            // READ
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'stockdate', name: 'stockdate'},
                    {data: 'supplier', name: 'supplier'},
                    {data: 'qty', name: 'qty'},
                    {data: 'pc', name: 'pc'},
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
                        title: 'Stock List',
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
                                   '\r\n <h2> Stock List </h2>'
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

            // Add Stock
            $('div').on('click', '.stockBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#id').val(id);
                $('#name').val(name);

                $("form").attr('id', 'addForm');

                $("#exampleModalCenterTitle").text(name+' အတွက် Stock ထပ်ထည့်မည်');

                $("#showModal").modal("show");
            });

            new Choices('.supplierchoice', {
               delimiter: ',',
               editItems: true,
               maxItemCount: 5,
               removeItemButton: true,
            });

            // ADD STOCK
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#id').val();
                var date = $('#date').val();
                var price = $('#price').val();
                var qty = $('#qty').val();
                var pc = $('#pc').val();

                console.log(id);

                if (document.getElementById('typeone').checked) 
                {
                    var type = document.getElementById('typeone').value;
                }
                else
                {
                    var type = document.getElementById('typetwo').value;

                }

                var sup_name = $('#sup_name').val();
                var sup_phone = $('#sup_phone').val();
                var sup_address = $('#sup_address').val();
                var sup_note = $('#sup_note').val();

                var sup_existingsupplier = $('#sup_existingsupplier').val();

                var url="{{url('additemStock/:id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    data: {date:date, price:price, qty:qty, pc:pc, type:type, sup_name:sup_name, sup_phone:sup_phone, sup_address:sup_address, sup_note:sup_note, sup_existingsupplier:sup_existingsupplier},
                    url: url,
                    type: "GET",
                    dataType: 'json',
                    success: function (data){

                        $('#addForm').trigger("reset");
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

            // Edit Stock
            $('tbody').on('click', '.editBtn', function (){

                var id = $(this).data('id');
                var stockdate = $(this).data('stockdate');
                var qty = $(this).data('qty');
                var pc = $(this).data('pc');
                var price = $(this).data('price');


                $('#id').val(id);
                $('#e_date').val(stockdate);
                $('#e_qty').val(qty);
                $('#e_pc').val(pc);
                $('#e_price').val(price);


                $("form").attr('id', 'editForm');


                $("#editstockModal").modal("show");
            });

            // UPDATE STOCK
            $("#editstockModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#id').val();
                var date = $('#e_date').val();
                var price = $('#e_price').val();
                var qty = $('#e_qty').val();
                var pc = $('#e_pc').val();


                var url="{{url('edititemStock/:id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    data: {date:date, price:price, qty:qty, pc:pc},
                    url: url,
                    type: "GET",
                    dataType: 'json',
                    success: function (data){

                        $('#editForm').trigger("reset");
                        table.draw();

                        $("#editstockModal").modal("hide");

                        $('.alert').removeClass('d-none');
                        $('.msg').html(data.success);

                        $(".alert").fadeOut(3000, function() {
                            $(this).addClass("d-none");
                            $(this).fadeIn();

                        });

                    },
                    error: function(error){
                        // console.log(error.responseJSON.errors);
                    }
                });
            });

            // DELETE
            $('tbody').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");

                console.log(id);
                
                var url="{{route('destroyitemStock',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: "ထို Stock ကို စာရင်းမှပယ်ဖျက်မည်!",
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
                            text: "ထို Stock အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ",
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
                            text: "ထိုကားအမှတ်တံဆိပ် အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။",
                            buttons: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

            var owl = $('.owl-carousel');
            owl.owlCarousel({
                animateOut: 'fadeOut',
                items: 1,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true
            });

        });
    </script>

@endsection
</x-backend>