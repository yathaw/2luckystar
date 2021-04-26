<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">ပင်မစာမျက်နှာ</h3>
            </div>
            
        </div>


    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mmfont"> ဒီနေ့ရောင်းရငွေ </h6>
                                        <h6 class="font-extrabold mb-0">{{ number_format($sale) }} Ks </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold mmfont">ကားပစ္စည်း</h6>
                                        <h6 class="font-extrabold mb-0">{{ $items }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Supplier</h6>
                                        <h6 class="font-extrabold mb-0">{{ $suppliers }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold"> Customer </h6>
                                        <h6 class="font-extrabold mb-0">{{ $customers }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @section('script_content')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var optionsProfileVisit = {
                annotations: {
                    position: 'back'
                },
                dataLabels: {
                    enabled:false
                },
                chart: {
                    type: 'bar',
                    height: 300
                },
                fill: {
                    opacity:1
                },
                plotOptions: {
                },
                series: [{
                    name: 'sales',
                    data: ["{{ $datas[0]['total'] }}", "{{ $datas[1]['total'] }}",
                            "{{ $datas[2]['total'] }}", "{{ $datas[3]['total'] }}",
                            "{{ $datas[4]['total'] }}", "{{ $datas[5]['total'] }}",
                            "{{ $datas[6]['total'] }}", "{{ $datas[7]['total'] }}",
                            "{{ $datas[8]['total'] }}", "{{ $datas[9]['total'] }}",
                            "{{ $datas[10]['total'] }}", "{{ $datas[11]['total'] }}"]
                }],
                colors: '#435ebe',
                xaxis: {
                    categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
                },
            }

            var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);

            chartProfileVisit.render();

        });
    </script>

@stop

</x-backend>