@extends($isAjax == false ? 'layout.master' : 'layout.empty')

@section('content')
<!-- Content page -->
<section class="p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <div class="search-product pos-relative bo4 of-hidden">
                        <input id="search-input" class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Pesquisar...">

                        <button onclick="searchByName()" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                            <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div><br>
                    <!--  -->
                    <h4 class="m-text14 p-b-7">
                        Categorias
                    </h4>
                    
                

                    <ul class="p-b-54">
                        <li class="p-t-4">
                            <a href="{{ url('shop-ajax?categoria=all') }}" class="s-text13 active1 content-to-load">
                                Todos
                            </a>
                        </li>

                        @foreach(getAllTypesOfItems() as $familia)
                        <li class="p-t-4">
                            <a href="{{ url('shop-ajax?categoria='.$familia->id) }}" href="#!" class="s-text13 content-to-load">
                                {{ $familia->titulo }}
                            </a>
                        </li>
                        @endforeach

                    </ul>

                    <!--  -->
                    <h4 class="m-text14 p-b-32">
                        Filtros
                    </h4>
                    @if( app('request')->input('enable_filter') != "true" )
                    <a href="{{url('/shop-ajax')}}?enable_filter=true" class="content-to-load flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
                        <span class="text-white">Abrir Filtros</span>
                    </a>
                    @else
                    <div class="filter-price p-t-22 p-b-50 bo3">
                        <div class="m-text15 p-b-17">
                            Preço
                        </div>

                        <div class="wra-filter-bar">
                            <div id="filter-bar"></div>
                        </div>

                        <div class="flex-sb-m flex-w p-t-16">
                            
                            <div class="s-text3 p-t-10 p-b-10">
                                De: <span id="price-value-lower">{{min($itemsPrices)}}</span>€ Até <span id="price-value-upper">{{max($itemsPrices)}}</span>€
                            </div>
                            
                        </div>
                        <div class="w-size11">
                            <!-- Button -->
                            <button onclick="filterPrices()" id="filter-price-button" class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
                                Filtrar
                            </button>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <span class="s-text8 p-t-5 p-b-5">
                        a mostrar de {{($items->currentPage()-1)* $items->perPage() + 1}} até 

                        @php
                            $to = ($items->currentPage()-1)* $items->perPage() + $items->perPage();
                            $total = $items->total();
                        @endphp

                        {{ $to >= $total ? $total : $to }} de   
                        {{ $total }} resultados
                    </span>
                </div>

                <!-- Product -->
                <div class="row">
                    @if($items->total() <= 0)
                        <h6>Não foram encontrados resultados para a sua pesquisa...</h6>
                    @else
                        @foreach($items as $item)
                            @if(setting('site.xd_software'))
                                <div data-price="{{$itemsPrices[$item->xd_id]}}" class="col-sm-12 col-md-6 col-lg-4 p-b-50 item">
                            @else
                                <div data-price="{{$itemsPrices[$item->name]}}" class="col-sm-12 col-md-6 col-lg-4 p-b-50 item">
                            @endif
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                        <img src="{{url('storage').'/'.$item->cover_image }}" alt="IMG-PRODUCT">

                                        <div class="block2-overlay trans-0-4">
                                            <a href="#!" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                            </a>

                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                                <!-- Button -->
                                                {{--<button data-id="{{$item->id}}" data-label="{{$item->name}}" data-price="{{$itemsPrices[$item->xd_id]}}" data-image="{{url('storage').'/'.$item->cover_image }}" class="cart-add flex-c-m size1 bg4 bo-rad-23 hov1 s-text8 trans-0-4">
                                                    Adicionar ao Carrinho
                                                </button>--}}

                                                <a href="{{ url('item-ajax').'/'.$item->id }}" class="content-to-load flex-c-m size1 bg4 bo-rad-23 hov1 s-text8 trans-0-4">
                                                    Ver Artigo
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt p-t-20">
                                        <a href="{{ url('item-ajax') . '/' . $item->id }}" class="block2-name dis-block s-text3 p-b-5 content-to-load">
                                            {{$item->name}}
                                        </a>

                                        <span class="block2-price m-text6 p-r-5">
                                            @if(setting('site.xd_software'))
                                                {{$itemsPrices[$item->xd_id]}}€
                                            @else
                                                {{$itemsPrices[$item->name]}}€
                                            @endif
                                            
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Pagination -->
                {{ $items->links('layout.pagination') }}

            </div>
        </div>
    </div>
</section>
@if(app('request')->input('enable_filter') == "true")
<script>
    $(document).ready(function(){
        loadPriceRangeSelector();
    });
</script>
@endif

@endsection

@section('js')
<script>
    $(document).ready(function(){
        loadPriceRangeSelector();
    });

    function loadPriceRangeSelector(){
        var slider = $('#filter-bar')[0];
        if(slider == null)
            return;
       
        noUiSlider.create(slider, {
            start: [minItemPrice, maxItemPrice],
            connect: true,
            range: {
                'min': minItemPrice,
                'max': maxItemPrice
            }
        });

        slider.noUiSlider.on('update', function (values) {
            $("#price-value-lower").html(values[0]);
            $("#price-value-upper").html(values[1]);
        });
    }
</script>
@endsection