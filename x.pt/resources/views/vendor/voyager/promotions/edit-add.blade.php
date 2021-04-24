@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                            @php
                                Session::put("Editing Item", true);
                                Session::put("dataTypeContent", $dataTypeContent);

                            @endphp
                        @else
                            @php
                                Session::put("Editing Item", false)
                            @endphp
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            @if($edit)


                                @php

                                    $value_end = $dataTypeContent->value_origin - $dataTypeContent->value;

                                @endphp


                                <div id="value" class="form-group  col-md-12">

                                    <label class="control-label" for="name" style="font-weight: bold;">Item</label>

                                    <input required="" type="text" class="form-control" value="{{ getNameItemById($dataTypeContent->items_id) }}" readonly></br>

                                    @if($dataTypeContent->attr_name != "no_attr")

                                        <input required="" type="text" class="form-control" name="attr_name" value="{{ $dataTypeContent->attr_name }}" readonly>
                                        
                                    @endif

                                    <input required="" type="text" class="form-control" name="values" value="{{ $dataTypeContent->values }}" readonly style="display: none;">

                                    <input required="" type="text" class="form-control" name="items_id" value="{{ $dataTypeContent->items_id }}" readonly style="display: none;">

                                </div>
                                <div class="form-group  col-md-12" style="margin-bottom: 20px;"></div>
                                
                                <div id="value" class="form-group  col-md-4">

                                    <label class="control-label" for="name" style="font-weight: bold;">Valor a descontar</label>

                                    <input required="" type="text" class="form-control" id="value" onkeyup="calculatePercentageWithValueNoAttr(this)" name="value" value="{{ $dataTypeContent->value }}">

                                </div>

                                <div id="value" class="form-group  col-md-4">

                                    <label class="control-label" for="name" style="font-weight: bold;">Percentagem a descontar</label>

                                    <input required="" type="text" class="form-control" id="percentage" onkeyup="calculatePercentageWithPercentageNoAttr(this)" name="percentage" value="{{ $dataTypeContent->percentage }}">

                                </div>

                                <div id="value" class="form-group  col-md-4">

                                    <label class="control-label" for="name" style="font-weight: bold;">Valor Final</label>

                                    <input required="" type="text" class="form-control" id="value_end" onkeyup="calculatePercentageWithValueEndNoAttr(this)" value="{{ $value_end }}">

                                    <input required="" type="text" class="form-control" id="value_origin" name="value_origin" value="{{ $dataTypeContent->value_origin }}" readonly style="display: none;">

                                </div>

                            @else

                                @foreach($dataTypeRows as $row)
                                    <!-- GET THE DISPLAY OPTIONS -->
                                    @php
                                        $display_options = $row->details->display ?? NULL;
                                        if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                            $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                        }
                                    @endphp
                                    @if (isset($row->details->legend) && isset($row->details->legend->text))
                                        <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                    @endif

                                    @if($row->display_name == "Item")
                                        <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                            {{ $row->slugify }}
                                            <label class="control-label" for="name" style="font-weight: bold;">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                            @include('voyager::multilingual.input-hidden-bread-edit-add')
                                            @if (isset($row->details->view))
                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add')])
                                            @elseif ($row->type == 'relationship')
                                                @include('voyager::formfields.relationship', ['options' => $row->details])
                                            @else
                                                {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                            @endif

                                            @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                            @endforeach
                                            @if ($errors->has($row->field))
                                                @foreach ($errors->get($row->field) as $error)
                                                    <span class="help-block">{{ $error }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="form-group  col-md-12" style="margin-bottom: 20px;"></div>
                                    @endif
                                @endforeach

                            @endif
                            

                            <div class="form-group col-md-12">
                                
                                <div id="check" style="display: none;">
    
                                    <i class="fa fa-spinner fa-spin"></i> A Verificar

                                </div>

                            </div>
                            

                            <div class="form-group col-md-12" id="postValues">
                                


                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer" id="button-save" style="display: none;">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>

        if("{{ $edit }}"){

            $("#button-save").show();
            
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

        }

        $(function() {

            $('select[name=items_id]').change(function(){
                if($('select[name=items_id]').val() == ""){
                    return;
                }
                $("#postValues").empty();
                $("#check").show();
                var item_id = $('select[name=items_id]').val();
                var values = { item_id : item_id };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    if("{{setting('site.xd_software')}}"){
                        $.ajax({
                            url: "{{url('/item/search/value')}}",
                            type: "POST", 
                            data: values,
                            success: function(result){
                                console.log(result);
                                if(result["attributesHTML"] != null){
                                    value = { values : result["itemInfo"], item_id : item_id };
                                    $.ajax({
                                        url: "{{url('/item/post/value')}}",
                                        type: "POST", 
                                        data: value,
                                        success: function(result){
                                            $("#postValues").html(result);
                                            $("#check").hide();
                                            $("#button-save").show();
                                    }});
                                }else{
                                    value = { values : result["itemInfo"], item_id : item_id };
                                    $.ajax({
                                        url: "{{url('/item/post/value/no-attr')}}",
                                        type: "POST", 
                                        data: value,
                                        success: function(result){
                                            $("#postValues").html(result);
                                            $("#check").hide();
                                            $("#button-save").show();
                                    }});
                                }
                        }});
                    }else{
                        $.ajax({
                            url: "{{url('/item/get/value')}}",
                            type: "POST", 
                            data: values,
                            success: function(result){
                                console.log(result);
                                if(result["result"] == "attr"){
                                    $("#postValues").html(result);
                                    $("#check").hide();
                                    $("#button-save").show();
                                }else{
                                    $("#postValues").html(result);
                                    $("#check").hide();
                                    $("#button-save").show();
                                }
                        }});
                    }
            });

        });

        function calculatePercentageWithValue(el){
            var id = $(el).val();
            var name = $(el).attr('string');
            var value_origin = $("input[id=value_origin_" + name + "]").val();
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
                    $("input[id=percentage_" + name + "]").val(result["percentage"]);
                    $("input[id=value_end_" + name + "]").val(result["value_end"]);
            }});
        }

        function calculatePercentageWithPercentage(el){
            var id = $(el).val();
            var name = $(el).attr('string');
            var value_origin = $("input[id=value_origin_" + name + "]").val();
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
                    $("input[id=value_" + name + "]").val(result["value"]);
                    $("input[id=value_end_" + name + "]").val(result["value_end"]);
            }});
        }

        function calculatePercentageWithValueEnd(el){
            var id = $(el).val();
            var name = $(el).attr('string');
            var value_origin = $("input[id=value_origin_" + name + "]").val();
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
                    $("input[id=percentage_" + name + "]").val(result["percentage"]);
                    $("input[id=value_" + name + "]").val(result["value"]);
            }});
        }

        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
