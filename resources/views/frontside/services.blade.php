<x-frontend>
	<div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">

            @foreach($spas as $spa)
            @php

                if(isset($spa->photo)){
                    $image = $spa->photo;
                }else{
                    $image = 'assets/preview.png';
                }


            @endphp

            <!-- Single Catagory -->
            <div class="single-products-catagory clearfix">
                <a href="{{ route('detail',$spa->id) }}">
                    <img src="{{ asset($image) }}" alt="">
                    <!-- Hover Content -->
                    <div class="hover-content">
                        <div class="line"></div>
                        <p class="badge bg-primary text-wrap text-white">{{ number_format($spa->price) }} Ks </p>
                        <h4 class="fw-bold">{{ $spa->name }}</h4>
                    </div>
                </a>
            </div>
            @endforeach
            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination justify-content-end mt-50">
                            {!! $spas->links() !!}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</x-frontend>