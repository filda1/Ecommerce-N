<input required="" type="text" class="form-control" name="ids[]" placeholder="Ids" value="no_attr" style="display: none;" readonly>

    <div id="value" class="form-group  col-md-4">

        <label class="control-label" for="name">Valor a descontar</label>

        <input required="" type="text" id="value" class="form-control" onkeyup="calculatePercentageWithValueNoAttr(this)" name="value[]" placeholder="Valor a descontar" value="0">

    </div>

    <div id="percentage" class="form-group  col-md-4">

        <label class="control-label" for="name">Percentagem a descontar</label>

        <input required="" type="text" id="percentage" class="form-control" onkeyup="calculatePercentageWithPercentageNoAttr(this)" name="percentage[]" placeholder="Percentagem a descontar" value="0">

    </div>

    <div id="value_end" class="form-group  col-md-4">

        <label class="control-label" for="name">Valor Final</label>

        <input required="" type="text" id="value_end" class="form-control" onkeyup="calculatePercentageWithValueEndNoAttr(this)" name="value_end[]" placeholder="Valor Final" value="{{ $values }}">

        <input required="" type="number" id="value_origin" class="form-control" name="value_origin[]" placeholder="Valor Original" value="{{ $values }}" style="display: none;" readonly>

    </div>

    <script>
        
        function calculatePercentageWithValueNoAttr(el){
            var id = $(el).val();
            var value_origin = $("input[id=value_origin").val();
            var values = { value : id, value_origin : value_origin };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{url('/item/calculate/percentage/with-value')}}",
                type: "POST", 
                data: values,
                success: function(result){
                    $("input[id=percentage").val(result["percentage"]);
                    $("input[id=value_end").val(result["value_end"]);
            }});
        }

        function calculatePercentageWithPercentageNoAttr(el){
            var id = $(el).val();
            var value_origin = $("input[id=value_origin").val();
            var values = { percentage : id, value_origin : value_origin };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{url('/item/calculate/percentage/with-percentage')}}",
                type: "POST", 
                data: values,
                success: function(result){
                    $("input[id=value").val(result["value"]);
                    $("input[id=value_end").val(result["value_end"]);
            }});
        }

        function calculatePercentageWithValueEndNoAttr(el){
            var id = $(el).val();
            var value_origin = $("input[id=value_origin").val();
            var values = { value_end : id, value_origin : value_origin };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{url('/item/calculate/percentage/with-value-end')}}",
                type: "POST", 
                data: values,
                success: function(result){
                    $("input[id=percentage").val(result["percentage"]);
                    $("input[id=value]").val(result["value"]);
            }});
        }

    </script>