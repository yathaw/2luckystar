<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">အရောင်းအ၀ယ်စာရင်း</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">အရောင်းအ၀ယ်စာရင်း</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <form method="get" action="{{route('report.index')}}">

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
                            <button type="submit" class="btn btn-light-primary d-none d-lg-block m-l-15 mt-4" id="searchBtn">
                                <i class="fas fa-search"></i> 
                            </button>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
    </section>

    <section class="section">
        @if(Request::get('sdate') && Request::get('edate'))
            <h4> {{ Request::get('sdate') }} - {{ Request::get('sdate') }} <span class="mmfont"> အတွင်းစာရင်းများ </span> </h4>
        @else
            <h4> {{ $date }} <span class="mmfont"> အတွက်စာရင်းများ </span> </h4>
        @endif
        
        <div class="row">
            <div class="col-lg-7 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
                            <a class="list-group-item list-group-item-action active mmfont"
                                id="list-sunday-list" data-bs-toggle="list" href="#list-sunday"
                                role="tab"> အရောင်းစာရင်း </a>
                            <a class="list-group-item list-group-item-action mmfont" id="list-monday-list"
                                data-bs-toggle="list" href="#list-monday" role="tab"> အ၀ယ်စာရင်း </a>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div id="searchresultDiv" class="row"></div>

                        <div class="tab-content text-justify">
                            <div class="tab-pane fade show active" id="list-sunday" role="tabpanel"
                                aria-labelledby="list-sunday-list">
                                <div class="row">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-lg">
                                            <thead class="text-center table-active">
                                                <tr>
                                                    <th class="mmfont"> ငွေတောင်းခံလွှာအမှတ် </th>
                                                    <th class="mmfont"> ရက်ဆွဲ </th>
                                                    <th class="mmfont"> ငွေပမာဏ </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $sale_total = 0; @endphp
                                                @foreach($sales as $sale)
                                                    @php 
                                                        $subtotal = $sale->total;
                                                        $sale_total += $subtotal++ ; 
                                                    @endphp
                                                    <tr>
                                                        <td> <a href="{{ route('sale.show', $sale->id) }}"> {{ $sale->invoiceno }} </a> </td>
                                                        <td> {{ $sale->saledate }} </td>
                                                        <td> {{ number_format($sale->total) }} Ks </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2"> <span class="mmfont"> စုစုပေါင်း </span> </th>
                                                    <th>
                                                        <span class="text-danger"> {{ number_format($sale_total) }} Ks </span>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="list-monday" role="tabpanel"
                                aria-labelledby="list-monday-list">
                                <div class="row">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-lg">
                                            <thead class="text-center table-active">
                                                <tr>
                                                    <th class="mmfont"> ကုဒ်နံပါတ်​ </th>
                                                    <th class="mmfont"> အမည် </th>
                                                    <th class="mmfont"> အရေအတွက် </th>
                                                    <th class="mmfont"> စျေးနှုန်း </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $purchase_total = 0; @endphp
                                                @foreach($purchases as $purchase)
                                                    @php 
                                                        $qty = $purchase->qty;
                                                        $price = $purchase->price;

                                                        $purchase_subtotal = $qty * $price;

                                                        $purchase_total += $purchase_subtotal++;

                                                    @endphp
                                                    <tr>
                                                        <td> <a href="{{ route('item.show', $purchase->i_id) }}"> {{ $purchase->codeno }} </a> </td>
                                                        <td> {{ $purchase->name }} </td>
                                                        <td> {{ $purchase->qty }} </td>
                                                        <td> {{ $purchase->price }} </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2"> <span class="mmfont"> စုစုပေါင်း </span> </th>
                                                    <th colspan="2">
                                                        <span class="text-danger"> {{ number_format($purchase_total) }} Ks </span>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mmfont"> စာရင်းဇယား </h5>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    @section('script_content')
    <script type="text/javascript">
        var expensetypeChoice;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var sale_total = "{{ $chartdatas['sale'] }}";
            var purchase_total = "{{ $chartdatas['purchase'] }}";
            var expense_total = "{{ $chartdatas['expense'] }}";


            let optionsVisitorsProfile  = {
                series: [parseInt(sale_total), parseInt(purchase_total), parseInt(expense_total)],
                labels: ['ရောင်းရငွေ', '၀ယ်ငွေ', 'အထွေထွေသုံးငွေ'],
                colors: ['#435ebe','#55c6e8', '#EB5056'],
                chart: {
                    type: 'donut',
                    width: '100%',
                    height:'350px'
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '30%'
                        }
                    }
                }
            }

            var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile);

            chartVisitorsProfile.render();

        });
    </script>

@stop

</x-backend>