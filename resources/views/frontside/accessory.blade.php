<x-frontend>

	<!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item mmfont">
                                	<a href="{{ route('home') }}">ပင်မစာမျက်နှာ</a>
                                </li>
                                <li class="breadcrumb-item mmfont">
                                	<a href="{{ route('accessory') }}">ကားပစ္စည်း</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                	{{ $item->codeno }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                @php
                    $images = json_decode($item->photo);
                    $a=1;
                @endphp

                <div class="row">

                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                        	@if(isset($images))
                            <div id="product_details_slider" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($images as $key => $image)
                                    <li class="{{$loop->iteration == 1 ? 'active' : ''}}" data-bs-target="#product_details_slider" data-bs-slide-to="{{ $a++ }}" style="background-image: url({{ asset($image) }});">
                                    </li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($images as $inner_key => $smallimage)

                                    <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                                        <a class="gallery_img" href="{{ asset($smallimage) }}">
                                            <img class="d-block w-100" src="{{ asset($smallimage) }}" alt="First slide">
                                        </a>
                                    </div>

                                    @endforeach
                                    
                                </div>
                            </div>
                            @else
                                <img src="{{ asset('assets/preview.png') }}" class="img-fluid" alt="">

                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">{{ number_format($item->price) }} Ks</p>
                                <a href="product-details.html">
                                    <h6>{{ $item->name }}</h6>
                                </a>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    
                                    <div class="review">
                                        <a href="#">{{ $item->codeno }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="short_overview my-5">
                                <p> {!! $item->description !!} </p>
                            </div>

                            <!-- Add to Cart Form -->
                            <button type="button" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->

</x-frontend>