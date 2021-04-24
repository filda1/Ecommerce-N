@extends($isAjax == false ? 'layout.master' : 'layout.empty')

@section('content')

	<!-- Product Detail -->
	<div class="container p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>
					@php 
						$images = json_decode($item->general_image, true);
					@endphp
					<div class="slick3">
					
						@if($item->image_type == "general" && $images != null)
							@foreach($images as $image)
								<div class="item-slick3" data-thumb="{{url('storage').'/'.$image}}">
									<div class="wrap-pic-w">
										<img src="{{url('storage').'/'.$image}}" alt="IMG-PRODUCT">
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
			</div>
			
		@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

			<div class="w-size14 p-t-30 respon5">
				<h4 data-label="{{$item->name}}" class="product-detail-name m-text16 p-b-13">
					{{$item->name}}
				</h4>

				<p class="s-text8 p-t-10">
					 {{$item->description}}
				</p>
				<!--  -->
				<div class="p-t-33 p-b-60">

					@php

						if(setting('site.xd_software')){
							$AttributeInfo = $itemInfo["result"][$item->xd_id]["AttributeInfo"];

							if(count($AttributeInfo["Prices"]) > 0){
								$priceAttributesIDS = array();
								$pricesAttributes = $AttributeInfo["Prices"];

								foreach($AttributeInfo["PriceAttributes"] as $price){
									array_push($priceAttributesIDS, $price["Id"]);
								}

								foreach($pricesAttributes as $key => $price){
									unset($pricesAttributes[$key]["PurchasePrice"]);
								}
							}
						}else{
							$AttributeInfo = $itemInfo[$item->id];

							if(count($AttributeInfo) > 0){
								$priceAttributesIDS = array();
								$pricesAttributes = $AttributeInfo;

								foreach($AttributeInfo as $price){
									if($price["price"] != null){
										array_push($priceAttributesIDS, $price["attr_id"]);
									}
								}

								foreach($pricesAttributes as $key => $price){
									unset($pricesAttributes[$key]["price"]);
								}
							}
						}

					@endphp

					@if(setting('site.xd_software'))

						@foreach($AttributeInfo["StockAttributes"] as $StockAttributes)
						<div class="flex-m flex-w p-b-10">
							<div class="s-text15 w-size15 t-center">
								{{$StockAttributes["Name"]}}
							</div>

							<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
								<select onchange="checkIfInfoNeedsToUpdate(this)" @if(isset($priceAttributesIDS)) data-controls-price="{{ in_array($StockAttributes['Id'], $priceAttributesIDS) ? 'True' : 'False' }}" @endif data-controls-image="{{ $attributeImageControlerID == $StockAttributes['Id'] ? 'True' : 'False' }}" class="selection-2" name="size">
									@foreach($StockAttributes["Values"] as $Attribute)
										<option data-atribute="{{$Attribute['Id']}}" data-item-attribute="{{$Attribute['ItemAttributeId']}}" value="{{$Attribute['Value']}}">{{$Attribute["Value"]}}</option>
									@endforeach
								</select>
							</div>
						</div>
						@endforeach

					@else

						@foreach($attr_category as $key => $category)

						<div class="flex-m flex-w p-b-10">
							<div class="s-text15 w-size15 t-center">
								{{$key}}
							</div>

							<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
								<select onchange="checkIfInfoNeedsToUpdate(this)" @if(isset($priceAttributesIDS)) data-controls-price="{{ in_array($category[0]['attr_id'], $priceAttributesIDS) ? 'True' : 'False' }}" @endif data-controls-image="{{ $attributeImageControlerID == $category[0]['attr_id'] ? 'True' : 'False' }}" class="selection-2" name="size">
									@foreach($category as $Attribute)
										<option data-atribute="{{$Attribute['id_attr']}}" data-item-attribute="{{$Attribute['attr_id']}}" value="{{$Attribute['name_attr']}}">{{$Attribute["name_attr"]}}</option>
									@endforeach
								</select>
							</div>
						</div>

						@endforeach

					@endif

					<div class="flex-r-m flex-w p-t-10">
						<div class="s-text15 w-size15 t-center">
							Quant.
						</div>
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							
						</div>
					</div>

					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							Preço
						</div>

						<span class="m-text16" id="price-holder">
							@if(setting('site.xd_software'))

								@if(count($AttributeInfo["Prices"]) > 0)
									{{number_format($AttributeInfo["Prices"][0]["Price1"]["TaxIncludedPrice"], 2)}}€
								@else
									{{number_format($itemInfo["result"][$item->xd_id]["RetailPrice1"], 2)}}€
								@endif

							@else

								@if(count($AttributeInfo) > 0)

									@if($item_price == null)

										{{number_format($AttributeInfo[0]["price"], 2)}}€

									@else

										{{number_format($item_price, 2)}}€

									@endif

								@else
									{{number_format($item_price, 2)}}€
								@endif

							@endif
							
						</span>
					</div>

					<div class="w-100 p-b-10">
						<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10 w-100">
							<!-- Button -->
							<button id="add-to-cart-button" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Adicionar ao Carrinho
							</button>
						</div>
					</div>

					

				</div>

				<div class="p-b-45">
					<span class="s-text8 m-r-35">Referência: {{$item->xd_id}}</span>
					<input type="hidden" id="item-id" value="{{ $item->id }}">

				</div>

				<!--  
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Descrição
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Informação Adicional
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Reviews (0)
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>-->
			</div>
		</div>
	</div>


	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Produtos Relacionados
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@foreach($itemsRelated as $itemRelated)
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src="{{url('storage').'/'.$itemRelated->cover_image }}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <a href="#!" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <!-- Button -->
                                        <a href="{{ url('item-ajax').'/'.$itemRelated->id }}" class="content-to-load flex-c-m size1 bg4 bo-rad-23 hov1 s-text8 trans-0-4">
                                            Ver Artigo
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="{{ url('item-ajax') . '/' . $itemRelated->id }}" class="block2-name dis-block s-text3 p-b-5 content-to-load">
                                    {{$itemRelated->name}}
                                </a>
                            </div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>

<script>

	var storageURL = "{{url('storage')}}/"

	@if(isset($pricesAttributes))

		@if(setting('site.xd_software'))
			var prices = @json($pricesAttributes);
		@else
			var prices = @json($attrs_price);
		@endif

	@endif

	var images = @json($atributesImagesParsed);

	function checkIfInfoNeedsToUpdate(el){
		if($(el).data('controls-price') == "True")
			checkIfPriceNeedsToUpdate();

		if($(el).data('controls-image') == "True")
			checkIfImageNeedsToUpdate(el);
	}

	function checkIfImageNeedsToUpdate(el){

		var elementsThatControlImage = $("[data-controls-image='True']");

		var attributesKey = getAttributeKeyId(elementsThatControlImage);

		if($(".slick3.slick-initialized").length > 0){
			$('.slick3').slick('unslick');
			$('.slick3').empty();
		}

		for (var i = 0; i < images[attributesKey].length; i++) {

			var imgURL = storageURL + images[attributesKey][i];

			var img =`<div class="item-slick3" data-thumb="${imgURL}">
						<div class="wrap-pic-w">
							<img src="${imgURL}" alt="IMG-PRODUCT">
						</div>
					</div>`;
			$(".slick3").append(img);
		}

		$('.slick3').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            dots: true,
            appendDots: $('.wrap-slick3-dots'),
            dotsClass:'slick3-dots',
            infinite: true,
            autoplay: false,
            autoplaySpeed: 6000,
            arrows: false,
            customPaging: function(slick, index) {
                var portrait = $(slick.$slides[index]).data('thumb');
                return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
            },  
        });
	}

	function checkIfPriceNeedsToUpdate(){

		var elementsThatControlPrice = $("[data-controls-price='True']");

		var attributesKey = getAttributeKeyId(elementsThatControlPrice);

		for (var i = 0; i < prices.length; i++) {

			@if(setting('site.xd_software'))
				if(checkAttributes(attributesKey, prices[i]["AttributesKey"])){
					$("#price-holder").html(number_format(prices[i]["Price1"]["TaxIncludedPrice"].toFixed(2), 2)+"€");
					$("#add-to-cart-button").attr('disabled', false);
					return;
				}
			@else
				if(checkAttributes(attributesKey, prices[i])){
					$("#price-holder").html(number_format(prices[i]["price"], 2)+"€");
					$("#add-to-cart-button").attr('disabled', false);
					return;
				}
			@endif

		}

		//If price does not exist, show message to user
		$("#price-holder").html("Indisponível");
		$("#add-to-cart-button").attr('disabled', true);
	}

	/*[ +/- num product ]
    ===========================================================*/
    $('.btn-num-product-down').on('click', function(e){
        e.preventDefault();
        var numProduct = Number($(this).next().val());
        if(numProduct > 1) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(e){
        e.preventDefault();
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    
 	$('#add-to-cart-button').on('click', function(e){
        e.preventDefault();

        var item = {};

		var elementsThatControlImage = $("[data-controls-image='True']");
		var attributesKey = getAttributeKeyId(elementsThatControlImage);
		var stringKey = "";
		var stringValue = "";
		elementsThatControlImage.each(function(index){
			stringValue = stringValue + $(this).val() + ",";
		});

		item["attributeImageKey"] = attributesKey;
		item["attributeImageValue"] = stringValue.substring(0, stringValue.length - 1);

		var elementsThatControlPrice = $("[data-controls-price='True']");
		var attributesKey = getAttributeKeyId(elementsThatControlPrice);
		var stringValue = "";
		elementsThatControlPrice.each(function(index){
			stringValue = stringValue + $(this).val() + ",";
		});

		item["attributePriceKey"] = attributesKey;
		item["attributePriceValue"] = stringValue.substring(0, stringValue.length - 1);

		item["quantity"] = parseFloat($('[name=num-product]').val());
		item["label"] = $('.product-detail-name').data('label');
		item["id"] = $('#item-id').val()+"-"+item["attributeImageKey"]+"-"+item["attributePriceKey"];
		item["image"] = $('.slick-current.slick-active').find('img').attr('src');
		item["price"] = parseFloat($('#price-holder').html());
		Cart.addItem(item);
    });

	$(document).ready(function(){
        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect2')
        });

        @if($item->image_type == "attr")
        	checkIfImageNeedsToUpdate();
        @endif

        @if($item->image_type == "general")
        	$('.slick3').slick({
	            slidesToShow: 1,
	            slidesToScroll: 1,
	            fade: true,
	            dots: true,
	            appendDots: $('.wrap-slick3-dots'),
	            dotsClass:'slick3-dots',
	            infinite: true,
	            autoplay: false,
	            autoplaySpeed: 6000,
	            arrows: false,
	            customPaging: function(slick, index) {
	                var portrait = $(slick.$slides[index]).data('thumb');
	                return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
	            },  
	        });
        @endif

        $('.slick2').slick({
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: true,
            autoplay: false,
            autoplaySpeed: 6000,
            arrows: true,
            appendArrows: $('.wrap-slick2'),
            prevArrow:'<button class="arrow-slick2 prev-slick2"><i class="fa  fa-angle-left" aria-hidden="true"></i></button>',
            nextArrow:'<button class="arrow-slick2 next-slick2"><i class="fa  fa-angle-right" aria-hidden="true"></i></button>',  
            responsive: [
                {
                  breakpoint: 1200,
                  settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                  }
                },
                {
                  breakpoint: 992,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                  }
                },
                {
                  breakpoint: 768,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 576,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
            ]    
        });
	});
</script>
@endsection
						