<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">Customer</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">Customer</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Customer List
                
            </div>
            <div class="card-body">
                

                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th class="mmfont">နံပါတ်စဥ်</th>
                            <th class="mmfont">အမည်</th>
                            <th class="mmfont">ဖုန်းနံပါတ်</th>
                            <th class="mmfont">လိပ်စာ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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

            // READ
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getlistCustomers') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'address', name: 'address'},
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
                        title: 'customer List',
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
                                   '\r\n <h2> customer List </h2>'
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

            

            // DELETE
            $('tbody').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('customer.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: "ထို Customerကို စာရင်းမှပယ်ဖျက်မည်!",
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
                            text: "ထိုcustomer အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ",
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
                            text: "ထိုcustomer အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။",
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