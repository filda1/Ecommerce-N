@extends($isAjax == false ? 'layout.master' : 'layout.empty')

@section('content')

    @if(json_decode($orders) == [])
    
        <style>
            
            #page-content{
                height: 100%;
            }

        </style>

    @endif

<div class="container">

    <div class="row order">

        @if(json_decode($orders) != [])

            @foreach($orders as $order)

                <div class="col-md-6">

                    @php

                        $state = getStateByOrderId($order->order_state);

                        $total = "";

                    @endphp

                    @if($order->order_state == "1")
                    <div class="alert alert-danger" role="alert" onclick="openPayment('{{ $order->type_payment }}', '{{ $order->id }}', '{{ $order->total }}')" style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 2%; background-color: #ffffff; border-color: #fff; color: #b1982f; cursor: pointer;">
                        {{ $state->state }}
                    </div>
                    @elseif($order->order_state == "2")
                    <div class="alert alert-warning" role="alert" onclick="openPayment('{{ $order->type_payment }}', '{{ $order->id }}', '{{ $order->total }}')" style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 2%; background-color: #ffffff; border-color: #fff; color: #8c8c8c; cursor: pointer;">
                        {{ $state->state }}
                    </div>
                    @elseif($order->order_state == "3")
                    <div class="alert alert-success" role="alert" onclick="openPayment('{{ $order->type_payment }}', '{{ $order->id }}', '{{ $order->total }}')" style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 2%; background-color: #ffffff; border-color: #fff; color: #5a8800; cursor: pointer;">
                        {{ $state->state }}
                    </div>
                    @else
                    <div class="alert alert-dark" role="alert" onclick="openPayment('{{ $order->type_payment }}', '{{ $order->id }}', '{{ $order->total }}')" style="text-align: center; font-size: 20px; font-weight: bold; margin-top: 2%; background-color: #ffffff; border-color: #fff; color: #3a3a3a; cursor: pointer;">
                        {{ $state->state }}
                    </div>
                    @endif

                    @foreach(json_decode($order->content) as $content)

                        @php

                            for ($i=0; $i < $content->quantity; $i++) { 
                                if($total == ""){
                                    $total = $content->price;
                                }else{
                                    $total = $total + $content->price;
                                }
                            }

                        @endphp

                        <h3 style="color: #404040; margin-top: 8px; margin-bottom: 8px;">{{ $content->label }}</h2>

                        <h4 style="color: #404040; margin-left: 15px; font-size: 16px; margin-top: 8px; margin-bottom: 8px;">Preço: {{ $content->price }}€</h2>

                        <h4 style="color: #404040; margin-left: 15px; font-size: 16px; margin-top: 8px; margin-bottom: 8px;">Quantidade: {{ $content->quantity }}</h2>

                    @endforeach

                    @php

                        $total = $order->total - $total;

                    @endphp

                    <h3 style="color: #404040; margin-bottom: 0; text-align: right;">Transporte: {{ $total }}€</h3>

                    <h3 style="color: #404040; margin-top: 0; text-align: right;">Total: {{ $order->total }}€</h3>

                </div>

            @endforeach

        @else

            <div class="col-md-12" style="text-align: center;">

                <h3>De momento ainda não fez nenhuma encomenda, visite a página de produtos para fazer as suas encomendas.</h3>

            </div>

        @endif

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalMBWay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: #000000ba;">
  <div class="modal-dialog" role="document">
    <div class="modal-content content content-mbw">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size: 30px;">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center; display: inline-grid; align-items: center; margin-bottom: 0; padding: 0 10px;">
        <p class="check-pay" style="">Por Favor, verifique a sua conta MBWay para proceder ao pagamento.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMultibanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: #000000ba;">
  <div class="modal-dialog" role="document">
    <div class="modal-content content content-mb">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="position: absolute; font-size: 1.5em;">Referência Multibanco</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size: 30px;">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin-bottom: 0; padding: 0;">
        <div class="col-md-12">
            
            <label>Entidade: </label>
            <p id="entidade" class="form-control-website"></p>

        </div>
        <div class="col-md-12" style="margin: 20px 0;">
            
            <label>Referência: </label>
            <p id="referencia" class="form-control-website"></p>
            
        </div>
        <div class="col-md-12">
            
            <label>Valor: </label>
            <p id="valor" class="form-control-website"></p>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: #000000ba;">
  <div class="modal-dialog" role="document">
    <div class="modal-content content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="position: absolute; font-size: 1.5em;">Pagamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size: 30px;">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin-bottom: 0; padding: 0;">
        <div class="col-md-12">
            
            <label>Nº de Conta: </label>
            <p id="n_account" class="form-control-website"></p>

        </div>
        <div class="col-md-12" style="margin: 20px 0;">
            
            <label>NIB: </label>
            <p id="nib" class="form-control-website"></p>

        </div>
        <div class="col-md-12">
            
            <label>BIC/SWIFT: </label>
            <p id="bic" class="form-control-website"></p>

        </div>
        <div class="col-md-12" style="margin: 20px 0;">
            
            <label>Valor: </label>
            <p id="valortb" class="form-control-website"></p>
            
        </div>
        <div class="col-md-12">
            
            <label>Encomenda: </label>
            <p id="encomenda" class="form-control-website"></p><br>
            <p class="form-control-website" style="color: red; border: 0; background-color: white;">Quando for fazer o pagamento, por favor meta na nota de pagamento o número da Encomenda!</p>
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<form style="display: none;" id="formToPaypal" method="post" action="{{ url('transacao') }}">
    @csrf
    <input type="text" name="type_payment">
    <input type="text" name="id">
</form>

<script>
    
    function openPayment(type_payment, id, total){
        if(type_payment == "paypal"){
            $("[name=type_payment]").val(type_payment);
            $("[name=id]").val(id);
            $("#formToPaypal").submit();
        }
        var values = { id : id , type_payment : type_payment };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            url: "{{url('/transacao')}}",
            type: "POST",
            data: values,
            success: function(result){
                if(type_payment == "tb"){
                    $("#n_account").html("{{ setting('site.n_account') }}");
                    $("#nib").html("PT50"+"{{ setting('site.nib') }}");
                    $("#bic").html("{{ setting('site.bic') }}");
                    $("#valortb").html(result["total"] + "€");
                    $("#encomenda").html(result["n_order"]);
                    $('#modalTB').modal('show');
                }
        }});
    }

</script>

@endsection