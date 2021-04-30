<x-frontend>
    <div class="amado_product_area section-padding-100">
        <div class="container-fluid">

            <div class="row">

                @foreach($items as $item)
                @php
                    $images = json_decode($item->photo);

                    if(isset($images)){
                        if(isset($images[1])){
                            $image2 = $images[1];
                        }else{
                            $image2 = $images[0];
                        }
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

                <!-- Single Product Area -->
                @if($currentstock > 0)

                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <a href="{{ route('info',$item->id) }}">

                                <img src="{{ asset($image) }}" alt="">
                                <!-- Hover Thumb -->
                                @if(isset($images))
                                    <img class="hover-img" src="{{ asset($image2) }}" alt="">
                                @endif
                            </a>
                        </div>

                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">{{ number_format($item->price) }}</p>
                                <a href="{{ route('info',$item->id) }}">
                                    <h6>{{ $item->name }}</h6>
                                </a>
                            </div>
                            <!-- Ratings & Cart -->
                            <div class="ratings-cart text-right">
                                <div class="ratings">
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                </div>
                                <div class="cart">
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Cart" data-id="{{ $item->id }}" data-codeno="{{ $item->codeno }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}" data-status="item" class="">
                                        <img src="{{ asset('assets/images/core-img/cart.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                {!! $items->links() !!}
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-frontend>
