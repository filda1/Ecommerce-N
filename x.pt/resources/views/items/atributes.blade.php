<h4 class="control-label" for="name">Selecione o atributo para controlo de imagem.</h4><br>

@foreach($attributeInfo as $atributes)
	@php

		$atribute = json_encode($atributes);

	@endphp
  	
  	<label class="radio-inline"><input id="{{ $atributes['Id'] }}" onclick="viewAtributes('{{ $atribute }}')" type="radio" name="optradio" value="{{ $atribute }}">{{ $atributes["Name"] }}</label>

@endforeach

<div id="check" style="display: none;">
	
	<i class="fa fa-spinner fa-spin"></i> A Verificar

</div>

<script>

	@if(Session::get("Editing Item"))
		$("#{{ getImageAttrByItem(Session::get('dataTypeContent')->id)[0]->attr_id }}").attr("checked", true);
		var attr = $("#{{ getImageAttrByItem(Session::get('dataTypeContent')->id)[0]->attr_id }}").val();
		viewAtributes(attr);
	@endif
	
	function viewAtributes(atributes){
		$("#detailsAtributes").empty();
		$("#check").show();
		$("input[name=optradio]").attr('disabled', true);
		$.ajax({url: "{{url('/atributes/details')}}"+ '/' + atributes, success: function(result){
            $("#detailsAtributes").html(result);
            $("#detailsAtributes").show();
            $("#check").hide();
			$("input[name=optradio]").attr('disabled', false);
        }});
	}

</script>