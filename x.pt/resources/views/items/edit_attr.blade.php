<div class="form-group  col-md-12" id="attr_on">

    @foreach($attr as $id => $attrValue)

        <div class="form-group  col-md-12">
            
            <label class="control-label" for="name">Nome do Atributo</label>

            @if($loop->last)

                @php

                    $id_nao_sei = $id + 1;

                @endphp

                <input required="" type="text" style="display: none;" class="form-control" name="nao_sei" value="{{$id_nao_sei}}">

            @endif

            <input required="" type="text" class="form-control" name="name_attr_{{$id}}" placeholder="Nome do Atributo" value="{{ $attrValue[$id]->attr_id_name }}">

            @if($attrValue[$id]->price != "")

                <label class="radio-inline"><input class="preco_{{$id}}" id="control_price[]" onclick="activePrice('{{$id}}')" type="radio" name="preco[]" checked>Controlo de Preço</label>

            @else

                <label class="radio-inline"><input class="preco_{{$id}}" id="control_price[]" onclick="activePrice('{{$id}}')" type="radio" name="preco[]">Controlo de Preço</label>

            @endif

            @if($attrValue[$id]->stock == "Sim")

                <label class="radio-inline"><input id="control_stock[]" type="radio" name="stock_{{$id}}" checked>Controlo de Stock</label>

            @else
                
                <label class="radio-inline"><input id="control_stock[]" type="radio" name="stock_{{$id}}">Controlo de Stock</label>

            @endif

            @if($attrValue[$id]->images_attr != "[]")

                <label class="radio-inline"><input class="imagem_{{$id}}" id="control_img[]" onclick="activeImage('{{$id}}')" type="radio" name="imagem" checked>Controlo de Imagem</label>

            @else

                <label class="radio-inline"><input class="imagem_{{$id}}" id="control_img[]" onclick="activeImage('{{$id}}')" type="radio" name="imagem">Controlo de Imagem</label>

            @endif

            <div id="add_other_attr_{{$id}}" onclick="addOtherAttrInAttr('{{$id}}')" class="btn2"><i class="fa fa-plus"></i></div>

        </div>

        @foreach($attrValue as $value)

            @if($loop->last)

                @php

                    $value_finaly = $value->id_attr + 1;

                @endphp

                <input required="" type="text" style="display: none;" class="form-control" name="value_image_{{$id}}" value="{{$value_finaly}}">

            @endif

            <div class="form-group  col-md-8">
                
                <label class="control-label" for="name">Atributo</label>

                <input required="" type="text" class="form-control" name="attr_{{$id}}[]" placeholder="Atributo" value="{{$value->name_attr}}">

            </div>

            @if($value->price != "")

                <div class="form-group  col-md-4 price_control_{{$id}}">
                    
                    <label class="control-label" for="name">Preço (€)</label>

                    <input type="number" step="any" class="form-control" name="preco_{{$id}}[]" placeholder="Preço" value="{{$value->price}}">

                </div>

            @else

                <div class="form-group  col-md-4 price_control_{{$id}}" style="display: none;">
                    
                    <label class="control-label" for="name">Preço (€)</label>

                    <input type="number" step="any" class="form-control" name="preco_{{$id}}[]" placeholder="Preço" value="{{$value->price}}">

                </div>

            @endif

            @if($value->images_attr != "[]")

                <div class="form-group  col-md-12 images_attr_attr_{{$id}}">
                
                    <label class="control-label" for="name">Imagens</label>

                    <div class="panel">
                        <div class="page-content settings container-fluid">
                            <div id="media_picker_images_attr_{{$id}}_{{$value->id_attr}}">
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
                                    :element="'input[name=&quot;images_attr_{{$id}}_{{$value->id_attr}}&quot;]'"
                                    :details="{'max':1,'min':0,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                                ></media-manager>
                                <input type="hidden" :value="'{{ $value->images_attr }}'" name="images_attr_{{$id}}_{{$value->id_attr}}">
                            </div>
                        </div>
                    </div>

                </div>

            @else

                <div class="form-group  col-md-12 images_attr_attr_{{$id}}" style="display: none;">
                
                    <label class="control-label" for="name">Imagens</label>

                    <div class="panel">
                        <div class="page-content settings container-fluid">
                            <div id="media_picker_images_attr_{{$id}}_{{$value->id_attr}}">
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
                                    :element="'input[name=&quot;images_attr_{{$id}}_{{$value->id_attr}}&quot;]'"
                                    :details="{'max':1,'min':0,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                                ></media-manager>
                                <input type="hidden" :value="[]" name="images_attr_{{$id}}_{{$value->id_attr}}">
                            </div>
                        </div>
                    </div>

                </div>

            @endif

            <script>
                
                new Vue({
                    el: '#media_picker_images_attr_{{$id}}_{{$value->id_attr}}'
                });

            </script>

        @endforeach

        <div class="form-group" id="other-attr-{{$id}}">
            


        </div>

        @if(!$loop->last)

            <div class="form-group  col-md-12" style="border-top: 2px solid #c1c1c1; margin: 10px 0"></div>

        @endif

    @endforeach

</div>

<script>
    
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
        console.log(imagem);
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

</script>