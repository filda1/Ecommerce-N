<link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
@foreach($atribute as $atributes)

	<input required="" type="text" class="form-control" name="valueAtribute[]" value="{{ $atributes->Value }}">

	<input required="" type="hidden" class="form-control" name="idAtribute[]" value="{{ $atributes->Id }}">

    <br>

	<div class="panel">
	    <div class="page-content settings container-fluid">
	        <div id="media_picker_images_attr_{{$loop->iteration-1}}">
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
	                :element="'input[name=&quot;images_attr_{{$loop->iteration-1}}&quot;]'"
	                :details="{'max':1,'min':0,'expanded':false,'show_folders':true,'show_toolbar':true,'allow_upload':true,'allow_move':true,'allow_delete':true,'allow_create_folder':true,'allow_rename':true,'allow_crop':true,'allowed':[],'hide_thumbnails':false,'quality':90}"
	            ></media-manager>
	            @if(Session::get("Editing Item"))
	            	<input type="hidden" :value="'{{ getImageAttrByItem(Session::get('dataTypeContent')->id)[$loop->iteration-1]->images_attr }}'" name="images_attr_{{$loop->iteration-1}}">
	            @else
	            	<input type="hidden" :value="''" name="images_attr_{{$loop->iteration-1}}">
	            @endif
	        </div>
	    </div>
	</div>
	
	<script>
	new Vue({
	    el: '#media_picker_images_attr_{{$loop->iteration-1}}'
	});
	</script>

	
@endforeach

<script>
	
	$("#button-submit").show();

</script>