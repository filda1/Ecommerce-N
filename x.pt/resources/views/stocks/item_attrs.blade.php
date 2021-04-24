@foreach($resultados as $id => $value)
<div class="form-group col-md-12">
	
	<label class="control-label" for="name">{{ $value[$id]->attr_id_name }}:</label></br>

	@foreach($value as $attr)

		@php

			$attrs_ids = "{" . $attr->attr_id . "," . $attr->id_attr . "}";

		@endphp

		<label class="radio-inline"><input type="radio" id="radio" name="{{$attr->attr_id_name}}" placeholder="{{$attr->name_attr}}" value="{{$attrs_ids}}">{{$attr->name_attr}}</label>

	@endforeach

</div>

@endforeach