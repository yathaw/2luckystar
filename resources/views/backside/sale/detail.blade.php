<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">အရောင်းအသေးစိတ်</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">အရောင်းအသေးစိတ်</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                    <div id="print_div">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('assets/voucherone.jpg') }}" class="img-fluid">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('assets/vouchertwo.jpg') }}" class="img-fluid">
                            </div>
                        </div>
                        

                        <h3><b>INVOICE</b> <span class="float-right" id="print_invoice"></span></h3>

                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <div class="float-start">
                                    <address>
                                        <h2> &nbsp;<b class="text-danger">2 Lucky Star </b></h2>
                                        <h4> Japan Car Accessories & Spa </h4>
                                        <p class="text-muted m-l-5 mmfont"> 
                                            အမှတ်(၂၇),ပုညဝဍနလမ်း,တာမွေမြို့နယ် 
                                        </p>
                                    </address>
                                </div>
                                <div class="float-end text-right">
                                    <address>
                                        <h4 class="font-bold"> {{ $sale->customer->name }} </h4>
                                        <p class="text-muted m-l-30">
                                            <span> {{ $sale->customer->phoneno }} </span> 
                                            <br>
                                            <span> {{ $sale->customer->address }} </span>
                                        </p>

                                        <p class="m-t-30"><b>Invoice Date :</b> 
                                            <i class="fa fa-calendar"></i> 
                                            <span> {{ date('M d, Y',strtotime($sale->saledate)) }} </span>
                                        </p>
                                    </address>
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Description</th>
                                                <th class="text-right">Quantity</th>
                                                <th class="text-right">Unit Cost</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $j = 1; $eachtotal =0; @endphp
                                            @foreach($sale->saledetails as $key => $sd)
                                            
                                            @php
                                                $qty = $sd->qty;
                                                if ($sd->item) 
                                                {
                                                    $price = $sd->item->price;
                                                    $codeno = $sd->item->codeno;
                                                    $name = $sd->item->name;
                                                }
                                                else
                                                {
                                                    $price = $sd->spa->price;
                                                    $codeno = $sd->spa->codeno;
                                                    $name = $sd->spa->name;
                                                }
                                                $subtotal = $price * $qty; 
                                            @endphp
                                                <tr>
                                                    <td class="text-center"> {{ $j++ }} </td>
                                                    <td>
                                                        <p class="mb-0"> {{ $codeno }} </p>
                                                        <small> {{ $name }} </small>
                                                    </td>
                                                    <td class="text-right"> {{ $sd->qty }} </td>
                                                    <td class="text-right"> {{ number_format($price) }} Ks </td>
                                                    <td class="text-right"> {{ number_format($subtotal) }} Ks </td>
                                                </tr>
                                                
                                            @php  $eachtotal += $subtotal++; @endphp
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            @php
                                $discount = $sale->discount;
                                $paymoney = $sale->paymoney;

                                $charge = $paymoney - ($eachtotal - $discount);

                                $total = $eachtotal - $discount;
                            @endphp

                            <div class="col-12">
                                <div class="float-end m-t-30">
                                    <p>Sub - Total amount: <span class="text-right"> {{ number_format($eachtotal) }} Ks </span> </p>
                                    <p> Discount  : <span class="text-right"> {{ number_format($discount) }} Ks </span>  </p>
                                    <p> Pay Amount  : <span class="text-right"> {{ number_format($paymoney) }} Ks </span> </p>
                                    <p> Charge  : <span class="text-right"> {{ number_format($charge) }} Ks </span></p>

                                    <hr>
                                    <h3><b>Total :</b> <span> {{ number_format($total) }} Ks </span> </h3>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <hr>
                    <div class="text-right float-end">
                        <button id="print" class="btn btn-danger" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
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

            $('.card').on('click', '#print', function()
            {
                var printContents =$('#print_div').html();
                // var originalContents = document.body.innerHTML;
                document.body.innerHTML=printContents;
                window.print();

                location.reload(); 
            });

            
        });

    </script>

@endsection

</x-backend>