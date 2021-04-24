<div class="form-group  col-md-12" style="border-top: 2px solid #c1c1c1; margin: 10px 0"></div>

<div class="form-group  col-md-12">
                                        
    <label class="control-label" for="name">Nome do Atributo</label>

    <input required="" type="text" class="form-control" name="name_attr_{{$id}}" placeholder="Nome do Atributo" value="">

    <input required="" type="text" style="display: none;" class="form-control" name="value_image_{{$id}}" value="1">

    <label class="radio-inline"><input class="preco_{{ $id }}" id="control_price[]" onclick="activePrice('{{ $id }}')" otherid="{{ $id }}" type="radio" name="preco[]">Controlo de Preço</label>

    <label class="radio-inline"><input id="control_stock[]" type="radio" name="stock_{{$id}}">Controlo de Stock</label>

    <label class="radio-inline"><input class="imagem_{{ $id }}" id="control_img[]" onclick="activeImage('{{ $id }}')" type="radio" name="imagem">Controlo de Imagem</label>

    <div id="add_other_attr_{{$id}}" onclick="addOtherAttrInAttr('{{ $id }}')" class="btn2"><i class="fa fa-plus"></i></div>

</div>

<div class="form-group  col-md-8">
    
    <label class="control-label" for="name">Atributo</label>

    <input required="" type="text" class="form-control" name="attr_{{$id}}[]" placeholder="Atributo" value="">

</div>

<div class="form-group  col-md-4 price_control_{{$id}}" style="display: none;">
    
    <label class="control-label" for="name">Preço (€)</label>

    <input type="number" step="any" class="form-control" name="preco_{{$id}}[]" placeholder="Preço" value="">

</div>

<div class="form-group  col-md-12 images_attr_attr_{{$id}}" style="display: none;">
    
    <label class="control-label" for="name">Imagens</label>

    <div class="panel">
        <div class="page-content settings container-fluid">
            <div id="media_picker_images_attr_{{$id}}_0">
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
                    :element="'input[name=&quot;images_attr_{{$id}}_0&quot;]'"
                    :details="{'max':1,'min':0,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                ></media-manager>
                <input type="hidden" :value="''" name="images_attr_{{$id}}_0">
            </div>
        </div>
    </div>

</div>

<div class="form-group" id="other-attr-{{$id}}">
                                        


</div>

<script>
    
    new Vue({
        el: '#media_picker_images_attr_{{$id}}_0'
    });

</script>