@foreach($items_attrs as $items_attr)

    @php
        
        $ids_finale_result = "{" . $items_attr->attr_id . "," . $items_attr->id_attr . "}";

    @endphp

    <input type="text" class="form-control" name="attr_name[]" value="{{ $items_attr->name_attr }}" readonly>

    <input required="" type="text" class="form-control" name="ids[]" placeholder="Ids" value="{{ $ids_finale_result }}" style="display: none;" readonly>

        <div id="value" class="form-group  col-md-4">

            <label class="control-label" for="name">Valor a descontar</label>

            <input required="" id="value_{{ $items_attr->id }}" string="{{ $items_attr->id }}" type="text" class="form-control" onkeyup="calculatePercentageWithValue(this)" name="value[]" placeholder="Valor a descontar" value="0">

        </div>

        <div id="percentage" class="form-group  col-md-4">

            <label class="control-label" for="name">Percentagem a descontar</label>

            <input required="" id="percentage_{{ $items_attr->id }}" string="{{ $items_attr->id }}" type="text" class="form-control" onkeyup="calculatePercentageWithPercentage(this)" name="percentage[]" placeholder="Percentagem a descontar" value="0">

        </div>

        <div id="value_end" class="form-group  col-md-4">

            <label class="control-label" for="name">Valor Final</label>

            <input required="" id="value_end_{{ $items_attr->id }}" string="{{ $items_attr->id }}" type="text" class="form-control" onkeyup="calculatePercentageWithValueEnd(this)" name="value_end" placeholder="Valor Final" value="{{ $items_attr->price }}">

            <input required="" id="value_origin_{{ $items_attr->id }}" type="number" class="form-control" name="value_origin[]" placeholder="Valor Original" value="{{ $items_attr->price }}" style="display: none;" readonly>

        </div>

@endforeach