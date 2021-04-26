@foreach($spas as $spa)

    <div class="col-6 my-2">
        <a href="javascript:void(0)" class="btn btn-light-primary btn-block shoppingcartBtn" data-id="{{ $spa->id }}" data-codeno="{{ $spa->codeno }}" data-name="{{ $spa->name }}" data-price="{{ $spa->price }}" data-status="spa">
            <h5> {{ $spa->codeno }} </h5>
            <small> {{ $spa->name  }}</small>
            <p> {{ $spa->price }} </p>
        </a>
    </div>

    @endforeach

    
    <div class="col-12 mt-3">

        <nav aria-label="Page navigation example">
            <ul class="spa_pagination justify-content-center">
                {!! $spas->links() !!}
            </ul>
        </nav>
        
    </div>