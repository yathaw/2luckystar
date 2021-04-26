@foreach($items as $item)
    @php
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

    <div class="col-6 my-2">
        <button class="btn btn-light-primary btn-block shoppingcartBtn @if($currentstock <= 0) disabled @endif" data-id="{{ $item->id }}" data-codeno="{{ $item->codeno }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}" data-status="item">
            <h5> 
                {{ $item->codeno }} 

            </h5>
            <small> {{ $item->name  }}</small>
            <p> 
                {{ $item->price }}
                <span class="badge bg-light-danger float-end mmfont "> {{ $currentstock }} ခု </span>
            </p>
        </button>
    </div>

@endforeach

<div class="col-12 mt-3">

    <nav aria-label="Page navigation example">
        <ul class="item_pagination justify-content-center">
            {!! $items->links() !!}
        </ul>
    </nav>
    
</div>