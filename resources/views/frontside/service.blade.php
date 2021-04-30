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
                                <li class="breadcrumb-item">
                                	<a href="{{ route('service') }}">SPA Service</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                	{{ $spa->codeno }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                

                <div class="row">

                    <div class="col-12 col-lg-7">
                        <div class="mb-2 single_product_thumb">
                        	@if(isset($spa->photo))
                                <img src="{{ asset($spa->photo) }}" class="img-fluid" alt="">
                                
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
                                <p class="product-price">{{ number_format($spa->price) }} Ks</p>
                                <a href="product-details.html">
                                    <h6>{{ $spa->name }}</h6>
                                </a>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    
                                    <div class="review">
                                        <a href="#">{{ $spa->codeno }}</a>
                                    </div>
                                </div>
                            </div>

                            

                            <!-- Add to Cart Form -->
                            <a href="" name="addtocart" value="5" class="btn amado-btn"> Booking </a>

                        </div>
                    </div>

                    <div class="col-12">
                        <p> {!! $spa->description !!} </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->

</x-frontend>