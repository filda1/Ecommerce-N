<label class="control-label" for="name">Imagem Geral</label>

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
            <input type="hidden" :value="'{{ Session::get('dataTypeContent')->general_image }}'" name="general_image">
        </div>
    </div>
</div>

<script>
	
	new Vue({
        el: '#media_picker_general_image'
    });

</script>