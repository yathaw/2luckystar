<x-frontend>
	<div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">

            @foreach($items as $item)
                @php
                    $images = json_decode($item->photo);

                    if(isset($images)){
                        $image = $images[0];
                    }else{
                        $image = 'assets/preview.png';
                    }

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
                <!-- Single Catagory -->
                @if($currentstock > 0)
                    <div class="single-products-catagory clearfix">
                        <a href="{{ route('info',$item->id) }}">
                            <img src="{{ asset($image) }}" alt="">
                            <!-- Hover Content -->
                            <div class="hover-content">
                                <div class="line"></div>
                                <p class="badge bg-primary text-wrap text-white">{{ number_format($item->price) }} Ks </p>
                                <h4 class="fw-bold">{{ $item->name }}</h4>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
            
        </div>
    </div>
</x-frontend>