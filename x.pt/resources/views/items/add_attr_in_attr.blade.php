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
            <div id="media_picker_images_attr_{{$id}}_{{$imagem}}">
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
                    :element="'input[name=&quot;images_attr_{{$id}}_{{$imagem}}&quot;]'"
                    :details="{'max':1,'min':0,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
                ></media-manager>
                <input type="hidden" :value="[]" name="images_attr_{{$id}}_{{$imagem}}">
            </div>
        </div>
    </div>

</div>

<script>
	
	new Vue({
        el: '#media_picker_images_attr_{{$id}}_{{$imagem}}'
    });

</script>