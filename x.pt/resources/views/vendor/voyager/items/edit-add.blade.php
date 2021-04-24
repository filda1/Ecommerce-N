<style>
    
    .btn1 {
      background-color: DodgerBlue; /* Blue background */
      border: none; /* Remove borders */
      color: white; /* White text */
      padding: 12px 16px; /* Some padding */
      font-size: 16px; /* Set a font size */
      cursor: pointer; /* Mouse pointer on hover */
      display: inline-block;
      margin-left: 40px;
      float: right;
    }

    /* Darker background on mouse-over */
    .btn1:hover {
      background-color: RoyalBlue;
    }

    .btn2 {
      background-color: DodgerBlue; /* Blue background */
      border: none; /* Remove borders */
      color: white; /* White text */
      padding: 12px 16px; /* Some padding */
      font-size: 12px; /* Set a font size */
      cursor: pointer; /* Mouse pointer on hover */
      display: inline-block;
      float: right;
    }

    /* Darker background on mouse-over */
    .btn2:hover {
      background-color: RoyalBlue;
    }

</style>
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
    @if(setting('site.xd_software'))
        <div class="col-md-12" id="itemNotFoundMessage" style="display: none;">
            <div class="alert alert-danger">
                <h4>Não foi encontrado um Item para este ID.</h4>
            </div>
        </div>

        <div class="col-md-12" id="itemAlertMessage" style="display: none;">
            <div class="alert alert-warning">
                <h4>A alteração de qualquer campo carregado através do Programa de Faturação, não será gravado no mesmo.</h4>
            </div>
        </div>
    @endif
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
                                $attr_encode = getAttrByItemId($dataTypeContent->id);
                                $attr = json_encode($attr_encode);
                                Session::put("attr", $attr);
                                if($attr_encode != []){
                                    $attrs = true;
                                    Session::put("attrs", true);
                                }else{
                                    $attrs = false;
                                    Session::put("attrs", false);
                                }
                                $checkplan = checkPlan();
                            @endphp
                        @else
                            @php
                                Session::put("Editing Item", false);
                                $attrs = false;
                                Session::put("attrs", false);
                                $checkplan = checkPlan();
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

                            @if(setting('site.xd_software'))


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
                                        @if($row->display_name == "Familia" || $row->display_name == "Categoria de Transporte" || $row->display_name == "PVP")
                                            <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                                {{ $row->slugify }}
                                                <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
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
                                        @endif

                                    @endforeach

                                    <div class="form-group  col-md-12 ">
                                            
                                        <label class="control-label" for="name" style="font-size: 2rem; margin: auto auto;">Qual o id do XD?</label>
                                        
                                        <div class="input-group">

                                            @if($edit)

                                                <input required="" type="text" class="form-control" name="xd_id" placeholder="XD Reference" value="{{ $dataTypeContent->xd_id }}" style="margin-top: 5px; margin-bottom: 5px;" readonly>
                                                <p style="color: red;">Não é possivel alterar este campo.</p>

                                            @else

                                                <input required="" type="text" class="form-control" name="xd_id" placeholder="XD Reference" value="{{ $dataTypeContent->xd_id }}" style="margin-top: 5px; margin-bottom: 5px;">


                                            @endif

                                            <span class="input-group-btn">
                                               <button id="button-check" onclick="checkReference(this)" type="button" class="btn btn-primary">Verificar</button>
                                            </span>

                                        </div>

                                    </div>

                                    <div class="form-group  col-md-12" id="itemCoverImage" style="display: none;">

                                        <label class="control-label" for="name">Imagem de Capa do Artigo</label>
                                            
                                        <div class="panel">
                                            <div class="page-content settings container-fluid">
                                                <div id="media_picker_cover_image">
                                                    <media-manager
                                                        base-path="items"
                                                        :allow-multi-select="false"
                                                        :max-selected-files="1"
                                                        :min-selected-files="1"
                                                        :show-folders="true"
                                                        :show-toolbar="true"
                                                        :allow-upload="true"
                                                        :allow-move="true"
                                                        :allow-delete="true"
                                                        :allow-create-folder="true"
                                                        :allow-rename="true"
                                                        :allow-crop="true"
                                                        :allowed-types="[]"
                                                        :pre-select="false"
                                                        :expanded="false"
                                                        :show-expand-button="false"
                                                        :element="'input[name=&quot;cover_image&quot;]'"
                                                        :details="{'max':1,'min':1,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                                                    ></media-manager>
                                                    <input type="hidden" :value="'{{ $dataTypeContent->cover_image }}'" name="cover_image">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group  col-md-12 " id="itemName" style="display: none;">

                                        <label class="control-label" for="name">Nome</label>
                                        
                                        <input required="" type="text" class="form-control" name="name" placeholder="Name" value="{{ $dataTypeContent->name }}">

                                    </div>
                                                                        
                                    <div class="form-group  col-md-12 " id="itemDescription" style="display: none;">

                                        <label class="control-label" for="name">Descrição</label>
                                        
                                        <input required="" type="text" class="form-control" name="description" placeholder="Description" value="{{ $dataTypeContent->description }}">

                                    </div>

                                    <div class="form-group  col-md-12 " id="itemAtributesNotFound" style="display: none;">
                                        
                                        

                                    </div>

                                    <div class="form-group  col-md-12 " id="itemAtributes" style="display: none;">
                                        


                                    </div>


                                    <div class="form-group  col-md-12 " id="detailsAtributes" style="display: none;">
                                        


                                    </div>

                            @else

                                @if($dataTypeContent->xd_id != null)

                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <h4>Você não pode alterar um artigo que tenha sido criado através do Programa de Faturação.</h4>
                                        </div>
                                    </div>

                                @else

                                    @if($edit)
                                        <input name="attr" value="{{ $attr }}" style="display: none;">
                                    @endif

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
                                        @if($row->display_name != "PVP" && $row->display_name != "Xd Id" && $row->display_name != "General Image" && $row->display_name != "Image Type" && $row->display_name != "Cover Image")
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

                                    <div class="form-group  col-md-12" id="itemCoverImage">

                                        <label class="control-label" for="name" style="font-weight: bold;">Imagem de Capa do Artigo</label>
                                            
                                        <div class="panel">
                                            <div class="page-content settings container-fluid">
                                                <div id="media_picker_cover_image">
                                                    <media-manager
                                                        base-path="items"
                                                        :allow-multi-select="false"
                                                        :max-selected-files="1"
                                                        :min-selected-files="1"
                                                        :show-folders="true"
                                                        :show-toolbar="true"
                                                        :allow-upload="true"
                                                        :allow-move="true"
                                                        :allow-delete="true"
                                                        :allow-create-folder="true"
                                                        :allow-rename="true"
                                                        :allow-crop="true"
                                                        :allowed-types="[]"
                                                        :pre-select="false"
                                                        :expanded="false"
                                                        :show-expand-button="false"
                                                        :element="'input[name=&quot;cover_image&quot;]'"
                                                        :details="{'max':1,'min':1,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                                                    ></media-manager>
                                                    <input type="hidden" :value="'{{ $dataTypeContent->cover_image }}'" name="cover_image">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group  col-md-12" style="margin-bottom: 20px;"></div>

                                    @if($checkplan != "Básico")

                                        <div class="form-group  col-md-12" id="atributte">

                                            <label class="control-label" for="name" style="font-weight: bold;">Atributos?</label>

                                            <div id="add_attr" onclick="addOtherAttr()" class="btn1" style="display: none;"><i class="fa fa-plus"></i></div>

                                            @if(!$edit)

                                                <input required="" type="text" style="display: none;" class="form-control" name="nao_sei" value="1">

                                                <input required="" type="text" style="display: none;" class="form-control" name="value_image_0" value="1">

                                            @endif

                                            </br>

                                            <input type="checkbox" name="atributte" class="toggleswitch" data-on="Sim" data-off="Não">

                                        </div>
                                        <div class="form-group  col-md-12" style="margin-bottom: 20px;"></div>

                                    @endif

                                    @if($dataTypeContent->image_type == "attr")

                                        <div class="form-group" id="attr_edit_on">



                                        </div>
                                        <div class="form-group  col-md-12" style="margin-bottom: 20px;"></div>

                                    @else

                                        <div class="form-group  col-md-12" id="attr_on" style="display: none;">

                                            <div class="form-group  col-md-12">
                                                
                                                <label class="control-label" for="name" style="font-weight: bold;">Nome do Atributo</label>

                                                <input type="text" class="form-control" name="name_attr_0" placeholder="Nome do Atributo" value="">

                                                <label class="radio-inline"><input class="preco_0" id="control_price[]" onclick="activePrice('0')" type="radio" name="preco[]">Controlo de Preço</label>

                                                <label class="radio-inline"><input id="control_stock[]" type="radio" name="stock_0">Controlo de Stock</label>

                                                <label class="radio-inline"><input class="imagem_0" id="control_img[]" onclick="activeImage('0')" type="radio" name="imagem">Controlo de Imagem</label>

                                                <div id="add_other_attr_0" onclick="addOtherAttrInAttr('0')" class="btn2"><i class="fa fa-plus"></i></div>

                                            </div>

                                            <div class="form-group  col-md-8">
                                                
                                                <label class="control-label" for="name">Atributo</label>

                                                <input type="text" class="form-control" name="attr_0[]" placeholder="Atributo" value="">

                                            </div>

                                            <div class="form-group  col-md-4 price_control_0" style="display: none;">
                                                
                                                <label class="control-label" for="name">Preço (€)</label>

                                                <input type="number" step="any" class="form-control" name="preco_0[]" placeholder="Preço" value="">

                                            </div>

                                            <div class="form-group  col-md-12 images_attr_attr_0" style="display: none;">
                                                
                                                <label class="control-label" for="name">Imagens</label>

                                                <div class="panel">
                                                    <div class="page-content settings container-fluid">
                                                        <div id="media_picker_images_attr_0_0">
                                                            <media-manager
                                                                base-path="items"
                                                                :allow-multi-select="true"
                                                                :max-selected-files="20"
                                                                :min-selected-files="0"
                                                                :show-folders="true"
                                                                :show-toolbar="true"
                                                                :allow-upload="true"
                                                                :allow-move="true"
                                                                :allow-delete="true"
                                                                :allow-create-folder="true"
                                                                :allow-rename="true"
                                                                :allow-crop="true"
                                                                :allowed-types="[]"
                                                                :pre-select="false"
                                                                :expanded="false"
                                                                :show-expand-button="false"
                                                                :element="'input[name=&quot;images_attr_0_0&quot;]'"
                                                                :details="{'max':1,'min':0,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                                                            ></media-manager>
                                                            <input type="hidden" :value="''" name="images_attr_0_0">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group" id="other-attr-0">
                                                


                                            </div>

                                        </div>
                                        <div class="form-group  col-md-12" style="margin-bottom: 20px;"></div>

                                    @endif

                                    <div class="form-group  col-md-12" id="image_general">
                                        
                                        <label class="control-label" for="name" style="font-weight: bold;">Imagens do Artigo</label>

                                        <br>

                                        <div class="panel">
                                            <div class="page-content settings container-fluid">
                                                <div id="media_picker_general_image">
                                                    <media-manager
                                                        base-path="items"
                                                        :allow-multi-select="true"
                                                        :max-selected-files="20"
                                                        :min-selected-files="0"
                                                        :show-folders="true"
                                                        :show-toolbar="true"
                                                        :allow-upload="true"
                                                        :allow-move="true"
                                                        :allow-delete="true"
                                                        :allow-create-folder="true"
                                                        :allow-rename="true"
                                                        :allow-crop="true"
                                                        :allowed-types="[]"
                                                        :pre-select="false"
                                                        :expanded="false"
                                                        :show-expand-button="false"
                                                        :element="'input[name=&quot;general_image&quot;]'"
                                                        :details="{'max':1,'min':0,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                                                    ></media-manager>
                                                    <input type="hidden" :value="'{{ $dataTypeContent->general_image }}'" name="general_image">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group  col-md-12" style="margin-bottom: 20px;"></div>

                                    <div class="form-group  col-md-12" id="price">
                                        
                                        <label class="control-label" for="name" style="font-weight: bold;">Preço do Artigo (€)</label>

                                        <input type="number" step="any" class="form-control" name="price" placeholder="Preço" value="{{ $dataTypeContent->price }}">

                                    </div>

                                @endif

                            @endif

                        </div>

                        @if($edit)
                            @if($dataTypeContent->xd_id == "")
                                <div id="button-submit" class="panel-footer" style="display: none;">
                                    @section('submit-buttons')
                                        <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                                    @stop
                                    @yield('submit-buttons')
                                </div>
                            @endif

                        @else

                            <div id="button-submit" class="panel-footer">
                                @section('submit-buttons')
                                    <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                                @stop
                                @yield('submit-buttons')
                            </div>

                        @endif
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

        if("{{setting('site.xd_software')}}"){
            $("#button-submit").show();
        }
        
        new Vue({
            el: '#media_picker_general_image'
        });

        new Vue({
            el: '#media_picker_images_attr_0_0'
        });

        $(function() {

            $('input[name=atributte]').change(function(){
                var atLeastOneIsChecked = $('input[name="atributte"]:checked').length > 0;
                if(atLeastOneIsChecked == true){
                    $("#attr_on").show();
                    $("#image_general").hide();
                    $("#price").hide();
                    $("input[name=general_image]").attr("value", "[]");
                    $("#add_attr").show();
                    if("{{ $edit }}"){
                        $("#atributte").append("<input required='' type='text' style='display: none;' class='form-control' name='nao_sei' value='1'>");
                        $("#atributte").append("<input required='' type='text' style='display: none;' class='form-control' name='value_image_0' value='1'>");
                    }
                }else{
                    $("#attr_on").hide();
                    $("#image_general").show();
                    $("#price").show();
                    $("#add_attr").hide();
                }
            });

        });

        new Vue({
            el: '#media_picker_cover_image'
        });

        if("{{ $edit }}"){
            if("{{setting('site.xd_software')}}"){
                checkReferenceAuto();
            }else{
                $('#radio_button').is(':checked');
                $("#button-submit").show();
                if("{{ $attrs }}"){
                    $("input[name=atributte]").prop("checked", true);
                    var atLeastOneIsChecked = $('input[name="atributte"]:checked').length > 0;
                    if(atLeastOneIsChecked == true){
                        $("#image_general").hide();
                        $("#price").hide();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            }
                        });
                        var attr = $("input[name=attr]").val();
                        var values = { result : attr };
                        $.ajax({
                            url: "{{url('/edit-attr')}}",
                            type: "POST", 
                            data: values,
                            success: function(result){
                                $("#attr_edit_on").html(result);
                        }});
                    }
                }
            }
        }
        

        function activePrice(id){
            var nao_sei = $("input[name=nao_sei]").val();
            for (var i = 0; i <= nao_sei; i++) {
                if(i != id){
                    $(".price_control_" + i).hide();
                }
            }
            $(".price_control_" + id).show();
        }

        function activeImage(id){
            var nao_sei = $("input[name=nao_sei]").val();
            for (var i = 0; i <= nao_sei; i++) {
                if(i != id){
                    $(".images_attr_attr_" + i).hide();
                }
            }
            $(".images_attr_attr_" + id).show();
        }

        function addOtherAttr(){
            var nao_sei = $("input[name=nao_sei]").val();
            var sum = 1;
            $.ajax({url: "{{url('/add-other-attr')}}"+ "/" + nao_sei, success: function(result){
                $("#attr_on").append(result);
                var total = sum += parseInt($("input[name=nao_sei]").val());
                $("input[name=nao_sei]").val(total);
            }});
        }

        function addOtherAttrInAttr(id){
            var nao_sei = id;
            $("#add_other_attr_" + nao_sei).hide();
            var imagem = $("input[name=value_image_" + nao_sei + "]").val();
            var sum = 1;
            $.ajax({url: "{{url('/add-other-attr-in-attr')}}"+ "/" + nao_sei + "/" + imagem, success: function(result){
                $("#other-attr-" + nao_sei).append(result);
                var total = sum += parseInt(imagem);
                $("input[name=value_image_" + nao_sei + "]").val(total);
                if($('.preco_' + nao_sei).is(':checked')){
                    activePrice(nao_sei);
                }
                if($('.imagem_' + nao_sei).is(':checked')){
                    activeImage(nao_sei);
                }
            }});
            $("#add_other_attr_" + nao_sei).show();
        }

        function checkReferenceAuto(){
            $("#button-check").html('<i class="fa fa-spinner fa-spin"></i> A Verificar');
            $("#button-check").attr('disabled', true);
            var xd_id = $("input[name=xd_id]").val();
            $.ajax({url: "{{url('/check-reference')}}"+ '/' + xd_id, success: function(result){
                console.log(result);
                var itemInfo = result["itemInfo"]["result"];
                if(itemInfo["error"] != undefined){
                    $("#itemNotFoundMessage").show();
                    $("#itemNotFoundMessage").html();
                    $("#itemName").hide();
                    $("#itemCoverImage").hide();
                    $("#itemDescription").hide();
                    $("#itemAlertMessage").hide();
                    $("#itemAtributesNotFound").hide();
                    $("#itemAtributesNotFound").empty();
                    $("#itemAtributes").hide();
                    $("#detailsAtributes").hide();
                    $("#button-submit").hide();
                }else{
                    $("#itemNotFoundMessage").hide();
                    $("#itemNotFoundMessage").empty();
                    $("input[name=name]").val(itemInfo[xd_id]["ShortName1"]);
                    $("input[name=description]").val(itemInfo[xd_id]["Description"]);
                    $("#itemName").show();
                    $("#itemDescription").show();
                    $("#itemCoverImage").show();
                    $("#itemAlertMessage").show();
                    $("#button-submit").hide();
                    if(result["attributesHTML"] == null){
                        $("#button-submit").hide();
                        $("#itemAtributes").empty();
                        $("#itemAtributes").hide();
                        $("#detailsAtributes").empty();
                        $("#detailsAtributes").hide();
                        $.ajax({url: "{{url('/general-image')}}", success: function(result){
                            $("#itemAtributesNotFound").html(result);
                            $("#itemAtributesNotFound").show();
                        }});
                        $("#button-submit").show();
                    }else{
                        $("#itemAtributesNotFound").hide();
                        $("#itemAtributesNotFound").empty();
                        $("#button-submit").hide();
                        $("#itemAtributesNotFound").hide();
                        $("#itemAtributesNotFound").empty();
                        $("#itemAtributes").html(result["attributesHTML"]);
                        $("#itemAtributes").show();
                    }
                }

                $("#button-check").html('Verificar');
                $("#button-check").attr('disabled', false);
            }});
        }

        function checkReference(button){
            if($("input[name=xd_id]").val() == "")
                return;
            $(button).html('<i class="fa fa-spinner fa-spin"></i> A Verificar');
            $(button).attr('disabled', true);
            var xd_id = $("input[name=xd_id]").val();
            $.ajax({url: "{{url('/check-reference')}}"+ '/' + xd_id, success: function(result){
                console.log(result);
                var itemInfo = result["itemInfo"]["result"];
                if(itemInfo["error"] != undefined){
                    $("#itemNotFoundMessage").show();
                    $("#itemName").hide();
                    $("#itemCoverImage").hide();
                    $("#itemDescription").hide();
                    $("#itemAlertMessage").hide();
                    $("#itemAtributesNotFound").hide();
                    $("#itemAtributes").hide();
                    $("#detailsAtributes").hide();
                    $("#button-submit").hide();
                }else{
                    $("#itemNotFoundMessage").hide();
                    $("input[name=name]").val(itemInfo[xd_id]["ShortName1"]);
                    $("input[name=description]").val(itemInfo[xd_id]["Description"]);
                    $("#itemName").show();
                    $("#itemDescription").show();
                    $("#itemCoverImage").show();
                    $("#itemAlertMessage").show();
                    $("#button-submit").hide();
                    if(result["attributesHTML"] == null){
                        $("#button-submit").hide();
                        $("#itemAtributes").empty();
                        $("#itemAtributes").hide();
                        $("#detailsAtributes").empty();
                        $("#detailsAtributes").hide();
                        $.ajax({url: "{{url('/general-image')}}", success: function(result){
                            $("#itemAtributesNotFound").html(result);
                            $("#itemAtributesNotFound").show();
                        }});
                        $("#button-submit").show();
                    }else{
                        $("#button-submit").hide();
                        $("#itemAtributesNotFound").hide();
                        $("#itemAtributesNotFound").empty();
                        $("#itemAtributes").html(result["attributesHTML"]);
                        $("#itemAtributes").show();
                    }
                }

                $(button).html('Verificar');
                $(button).attr('disabled', false);
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
