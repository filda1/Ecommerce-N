@extends($isAjax == false ? 'layout.master' : 'layout.empty')

@section('content')

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Item</th>
							<th class="column-3">Preço Quant.</th>
							<th class="column-4 p-l-70">Quandidade</th>
							<th class="column-5">Total</th>
						</tr>
						<tbody class="cart-table-items cart-table-items">
							
						</tbody>
					</table>
				</div>
			</div>

      
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<!--<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Código de desconto">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Aplicar Desconto
						</button>
					</div>-->
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<div class="header-cart-total">
						Total: 
                        <span class="cart-subtotal"></span>
                    </div>
				</div>
			</div>


			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Total de Carrinho
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						<span class="cart-subtotal"></span>
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-100">
						Custos de Transporte
					</span>

					<div id="transporte-pais" class="w-100 w-full-sm">
						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden m-t-8 m-b-12">
							<select onchange="updateCartTransportCost(this)" class="selection-2" name="country">
								<option disabled selected>Selecione o região...</option>
								
						         <option value="0.00">Portes Grátis (0.00€)</option>
							  
					
							</select>
						</div>
					</div>

           
					<p id="no-login" style="color: red!important; margin-bottom: 20px; display: none;">Faça login para proceder à compra.</p>

					<p id="no-endereco" style="color: red!important; margin-bottom: 20px; display: none;">Verifique os seus endereços de envio no seu perfil.</p>

					<span class="s-text18 w-size19 w-full-sm">
						Custo
					</span>

					<div class="w-size20 w-full-sm">
						<span id="cart-transport-cost">Selecione uma região para ver o custo de transporte</span>
					</div>
				</div>

				<div class="flex-w flex-sb-m bo10 p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span id="total-cart" class="m-text21 w-size20 w-full-sm">
						Selecione uma região para ver o total do pedido
					</span>
				</div>

				<style>
									
					[type=radio] { 
					  position: absolute;
					  opacity: 0;
					  width: 0;
					  height: 0;
					}

					/* IMAGE STYLES */
					[type=radio] + img {
					  cursor: pointer;
					}

					/* CHECKED STYLES */
					[type=radio]:checked + img {
					  outline: 2px solid #669;
					}

				</style>

				<div class="flex-w flex-sb p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-100">
						Metodo de Pagamento
					</span>

					@if(setting('site.n_banco') != NULL && setting('site.nib') != NULL && setting('site.n_account') != NULL && setting('site.bic') != NULL)

						<label style="width: 40%;">
							<input type="radio" name="pay" value="tb">
							<img id="tb" alt="tb" src="{{asset('images/metodos_pagamentos/transferencia_bancaria.png')}}" width="100%" height="100%">
						</label>

					@endif

					@if(setting('site.paypal_username') != NULL && setting('site.paypal_password') != NULL && setting('site.paypal_signature') != NULL)

						<label style="width: 40%;">
							<input type="radio" name="pay" value="paypal">
							<img id="paypal" alt="paypal" src="{{asset('images/metodos_pagamentos/paypal.png')}}" width="100%" height="100%">
						</label>

					@endif

					@if(setting('site.n_banco') == NULL && setting('site.nib') == NULL && setting('site.n_account') == NULL && setting('site.bic') == NULL && setting('site.paypal_username') == NULL && setting('site.paypal_password') == NULL && setting('site.paypal_signature') == NULL)

						<p>Pagamento à cobrança.</p>

					@endif
					
						<p>Pagamento à cobrança.</p>

					<p id="error-pay" style="color: red!important; display: none;">Ocorreu um erro, tente novamente mais tarde.</p>
					<p id="error-endereco" style="color: red!important; display: none;">Verifique se tem um endereço de envio ativo no seu perfil.</p>
					<p id="login-error" style="color: red!important; display: none;">Efetue o login na sua conta para proceder à finalização do pedido.</p>
					
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="finalizeOrder" onclick="finalizeOrder()">
						Finalizar Pedido
					</button>
				</div>
			</div>
		</div>
	</section>





 <!--View Ecomenda-->
	<div class="modal fade" id="modalTB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: #000000ba;" onclick="closeModalTB()">
		<div class="modal-dialog" role="document">
			<div class="modal-content content">
			  <div class="modal-header">
			     <h5 class="modal-title" id="exampleModalLabel" style="position: absolute; font-size: 1.5em;">   Artigos da Ecomenda</h5>
			     <br><p class="" style="font-size: 12px;"><p style="font-weight: bold;">Successo!!</p>. Foi-lhe enviado um email com o detalhe do pedido </p>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      <span aria-hidden="true" style="font-size: 30px;">&times;</span>
			    </button>
			    
			      
			  </div>
		
			  <div class="modal-body" style="margin-bottom: 0; padding-left: 10; padding-right: 10;">
			         <!--	<label>Nome do Banco:</label>
			    	<p class="form-control-website">{{setting('site.nib')}}</p>-->
			    	
                      <table class="table table-bordered; table-responsive" >
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Artigos</th>
                              <th scope="col">Detalhe</th>
                            
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td><label>Encomenda:</label></td>
                              <td><p id="n_order" class=""></p ></td>
                             
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td>  <label>Descrição:</label> </td>
                              <td><p id="description" class=""></p></td>
                             
                            </tr>
                            <tr>
                              <th scope="row">3</th>
                              <td > <label>Quantidade:</label> </td>
                              <td><p id="qta" class=""></p></td>
                            </tr>
                            
                             <tr>
                              <th scope="row">4</th>
                              <td > <label>Pagamento:</label> </td>
                              <td><p class=""> Pagamento à cobrança - Portes Grátis</p></td>
                            </tr>
                            
                              <tr>
                              <th scope="row">5</th>
                              <td > <label>Valor a pagar:</label> </td>
                              <td><p id="valortb" class=""></p></td>
                            </tr>
                            
                          </tbody>
                     </table>

	    
			    
			    
			  </div>
			  
			  <div class="modal-footer">
			    
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			  </div>
			</div>
		</div>
	</div>


	<form style="display: none;" id="formToPaypal" method="post" action="{{ url('finalize-order') }}">
	    @csrf
	    <input type="text" name="cartitem">
	    <input type="text" name="transport">
	    <input type="text" name="pagamento">
	</form>

<script>


    $( window ).on('load', function() {
   		setTimeout(function(){
   			Cart.trigger('saved');	
			checkAvailableTransportOptions();
   		},0);
	});

	Cart.trigger('saved');	
	checkAvailableTransportOptions();
	$(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

	function checkAvailableTransportOptions(){
		var cartItemsIds = Cart.items.map(a => a.id).join(',');
       console.log(cartItemsIds);
		$.ajax(
			{
				url: "{{url('cart-check-available-transport-options-ajax')}}?items_ids="+cartItemsIds, 
				success: function(result){
					console.log(result);
					if(result["status"] == "ok"){
						var options = result["result"];
						for (var i = 0; i <= options.length - 1; i++) {
							var optionID = options[i]["id"];
							var optionCountryName = options[i]["country_name"];
							var optionPrice = options[i]["price"];

                       
						//$('[name=country]').append(`<option data-price="${optionPrice}" value="${optionID}">${optionCountryName}</option>`);
						//	$('[name=country]').append(`<option data-price="0.00" value="0.00">${optionCountryName} - Portes Grátis (0.00€)</option>`);
						}
					}else if(result["status"] == "error_login"){
						$("#transporte-pais").hide();
						$("#no-login").show();
					
					}else if(result["status"] == "error_endereco"){
						$("#transporte-pais").hide();
						$("#no-endereco").show();
					}else{
						//location.reload();
					}
						
			  	}
			  
	 		}
 		);
 		
 		//location.reload();
	}

	function updateCartTransportCost(el){
		//var price = $(el).find("option:selected").data("price");
		
		//var value = e.options[e.selectedIndex].value;
		//console.log(value);
		
		//alert(el.value);
		
		var price = el.value;
		
		$("#cart-transport-cost").html(`${price}€`);

		var total = (1 * Cart.subTotal()) + (1 * parseFloat(price, 10).toFixed(2));

		$("#total-cart").html(`${total.toFixed(2)}€`);
	}

	function finalizeOrder(){
        $("#error-pay").hide();
        $("#error-endereco").hide();
        var cartitem = localStorage.getItem("cart-items");
        //var pagamento = $('input[name=pay]:checked').val();
        var pagamento = "zero";
        var transport = $('select[name=country]').val();
        var numero = "";
        var cripto = "";
        var validade = "";

        //var pagamento = "tb";
     

        if("{{Auth::check()}}" == 0){
        	$("#login-error").show();
        }

        if(pagamento == undefined){
        	$("#error-pay").show();
        }

        if(cartitem == [] || pagamento == undefined || transport == null || "{{Auth::check()}}" == 0){
            return;
        }

        if("{{checkUserEndereco()}}" == "error_endereco"){
        	$("#error-endereco").show();
        	return;
        }

       /* if(pagamento == "paypal"){
            $("[name=cartitem]").val(cartitem);
            $("[name=transport]").val(transport);
            $("[name=pagamento]").val(pagamento);
            cartEmpty();
            $("#formToPaypal").submit();
        }*/

       /* if(pagamento == "cc"){
            numero = $('input[name=numero]').val();
            cripto = $('input[name=cripto]').val();
            validade = $('input[name=validade]').val();
            if (numero == "" || cripto == "" || validade == "") {
                return;
            }
        }*/
		//pagamento == "";
		pagamento == "zero";
        numero = "";
        cripto = "";
        validade = "";

      

       var values = { cartitem : cartitem , pagamento : pagamento , transport : transport , numero : numero , cripto : cripto , validade : validade };
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            url: "{{url('/finalize-order')}}",
            type: "POST", 
            data: values,
            success: function(result){
               
                if(result["result"] == "correct"){
                    
                                
                                    var valor = result["total"];
                                    var numero_order = result["numero_order"];
                                    var type_payment = result["type_payment"];
                                    var description= result["description"];
                                    
                                     var name = result["name"];
                                     var qta = result["qta"];
                                     var image= result["image"];
                                
                     
                   /* var valor = result["valor"];
                    $("#n_account").html(result["n_account"]);
                    $("#nib").html("PT50"+result["nib"]);
                    $("#bic").html(result["bic"]);
                    $("#valortb").html(valor.toFixed(2) + "€");
                    $("#encomenda").html(result["encomenda"]);
                    $('#modalTB').modal('show');*/
                    
                  
                                        
                                         $("#n_order").html(numero_order); 
                                         $("#qta").html(qta); 
                                         $("#type").html(type_payment );
                                         $("#description").html(name);
                                         $("#valortb").html(valor.toFixed(2) + "€");
                                           
                                         $("#encomenda").html(result["encomenda"]);
                                         $('#modalTB').modal('show');
                      
                    
                    /////NEW/////
                    /*if(pagamento == "cc"){
                        window.open(result["url"]);
                        localStorage.removeItem("cart-items");
                        location.reload();
                    }else if(pagamento == "mbway"){
                        $('#modalMBWay').modal('show');
                    }else if(pagamento == "multibanco"){
                        var valor = result["valor"];
                        $("#entidade").html(result["entidade"]);
                        $("#referencia").html(result["referencia"]);
                        $("#valor").html(valor.toFixed(2));
                        $('#modalMultibanco').modal('show');
                    }*/
                    
                     /////NEW/////
                }else if(result["result"] == "error"){
                    $("#error-pay").show();
                    console.log( "err" );
                }else if(result["result"] == "error_endereco"){
					$("#error-endereco").show();
					 console.log( "err" );
                }
               }else if(result["result"] == "error_login"){
                 
					$("#error-login").show();
					 console.log( "err" );
					
                }
        }});
    }

    function cartEmpty(){
    	localStorage.removeItem("cart-items");
    }

    function closeModalTB(){
        $('#modalTB').modal('hide');
        localStorage.removeItem("cart-items");
        location.reload();
    }

</script>
@endsection