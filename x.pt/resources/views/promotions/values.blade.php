@php

    $prices = $values["Prices"];

    $attributes = $values["PriceAttributes"];

@endphp

@foreach($prices as $price)

@php

    $attr = preg_split('/[;}{]/', $price["AttributesKey"]);

    $attr_corrects = array_filter($attr);

    $item_id = $price["ItemKeyId"];

    $attr_results = "";

    $results = "";

    $ids_results = "";

    $ids_finale_result = "";

    $ids_name = "";

    $ids_results_name = "";

@endphp

    @foreach($attr_corrects as $attr_correct)

        @php

            $attr_correct = explode(',', $attr_correct);

            $id_attr = $attr_correct[0];

            $id_attr_value = $attr_correct[1];

            $result = getNameAttrAndNameAttrValue($item_id, $id_attr, $id_attr_value, $attributes);

            $results = $result["Attr"] . " - " . $result["Attr_Value"];

            $ids_results = "{" . $id_attr . "," . $id_attr_value . "}";

            $ids_results_name = $id_attr . "_" . $id_attr_value;

            if($ids_finale_result == ""){
                $ids_finale_result = $ids_results;
            }else{
                $ids_finale_result = $ids_finale_result . ";" . $ids_results;
            }

            if($ids_name == ""){
                $ids_name = $ids_results_name;
            }else{
                $ids_name = $ids_name . "_" . $ids_results_name;
            }

            if($attr_results == ""){
                $attr_results = $results;
            }else{
                $attr_results = $attr_results . " / " . $results;
            }

        @endphp

    @endforeach

    <input type="text" class="form-control" name="attr_name[]" value="{{ $attr_results }}" readonly>

    <input required="" type="text" class="form-control" name="ids[]" placeholder="Ids" value="{{ $ids_finale_result }}" style="display: none;" readonly>

        <div id="value" class="form-group  col-md-4">

            <label class="control-label" for="name">Valor a descontar</label>

            <input required="" id="value_{{ $ids_name }}" string="{{ $ids_name }}" type="text" class="form-control" onkeyup="calculatePercentageWithValue(this)" name="value[]" placeholder="Valor a descontar" value="0">

        </div>

        <div id="percentage" class="form-group  col-md-4">

            <label class="control-label" for="name">Percentagem a descontar</label>

            <input required="" id="percentage_{{ $ids_name }}" string="{{ $ids_name }}" type="text" class="form-control" onkeyup="calculatePercentageWithPercentage(this)" name="percentage[]" placeholder="Percentagem a descontar" value="0">

        </div>

        <div id="value_end" class="form-group  col-md-4">

            <label class="control-label" for="name">Valor Final</label>

            <input required="" id="value_end_{{ $ids_name }}" string="{{ $ids_name }}" type="text" class="form-control" onkeyup="calculatePercentageWithValueEnd(this)" name="value_end" placeholder="Valor Final" value="{{ $price[$price_value]['TaxIncludedPrice'] }}">

            <input required="" id="value_origin_{{ $ids_name }}" type="number" class="form-control" name="value_origin[]" placeholder="Valor Original" value="{{ $price[$price_value]['TaxIncludedPrice'] }}" style="display: none;" readonly>

        </div>

@endforeach