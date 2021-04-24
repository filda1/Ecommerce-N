<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use App\ItemsAttrImage;
use App\Item;
use App\Config;

class ItemsController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $item = Item::count();

        $config = Config::first();

        if($config->produtos != 0){
            if($item == $config->produtos){
                return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                        'message'    => 'Chegou ao limite de artigos!',
                        'alert-type' => 'error',
                    ]);
            }
        }

        $request = $request;

        if($request["general_image"] == null){
            $request["general_image"] = "[]";
        }

        if(setting('site.xd_software')){

            $item = Item::where("xd_id", $request["xd_id"])->first();

            if($item != []){
                return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                        'message'    => 'Este artigo já existe!',
                        'alert-type' => 'error',
                    ]);
            }

            $request["familia_id"] = $request["item_belongsto_familia_relationship"];

            $request["transport_category_id"] = $request["item_belongsto_transport_category_relationship"];

            if($request["general_image"] == "[]"){
                $request["image_type"] = "attr";
            }else{
                $request["image_type"] = "general";
            }

        }else{

            $item = Item::where("name", $request["name"])->first();

            if($item != []){
                return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                        'message'    => 'Este artigo já existe!',
                        'alert-type' => 'error',
                    ]);
            }

            if($request["general_image"] == "[]"){
                $request["image_type"] = "attr";
            }else{
                $request["image_type"] = "general";
            }

        }

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        if(setting('site.xd_software')){

            if($request["general_image"] == "[]"){
                foreach ($request["idAtribute"] as $keyId => $valueIdAtribute) {
                    foreach ($request["valueAtribute"] as $keyValue => $valueAtribute) {
                        if($keyId == $keyValue){
                            $attrImage = new ItemsAttrImage();
                            $attrImage->items_id = $data->id;
                            $attrImage->attr_id = json_decode($request["optradio"])->Id;
                            $attrImage->id_attr = $valueIdAtribute;
                            $attrImage->name_attr = $valueAtribute;
                            $attrImage->images_attr = $request["images_attr_$keyId"];
                            $attrImage->save();
                        }
                    }
                }
            }

        }else{

            if($request["general_image"] == "[]"){

                $request["nao_sei"] = $request["nao_sei"] - 1;

                for ($i=0; $i <= $request["nao_sei"]; $i++) { 
                    foreach($request["attr_" . $i] as $keyAttr => $valueAttr){
                        foreach($request["preco_" . $i] as $keyPreco => $valuePreco){
                            if($keyAttr == $keyPreco){
                                $attrImage = new ItemsAttrImage();
                                $attrImage->items_id = $data->id;
                                $attrImage->attr_id = $i;
                                $attrImage->id_attr = $keyAttr;
                                $attrImage->name_attr = $valueAttr;
                                $attrImage->images_attr = $request["images_attr_" . $i . "_" . $keyAttr];
                                $attrImage->price = $valuePreco;
                                $attrImage->attr_id_name = $request["name_attr_" . $i];
                                if($request["stock_" . $i] == "on"){
                                    $attrImage->stock = "Sim";
                                }else{
                                    $attrImage->stock = "Não";
                                }
                                $attrImage->save();
                            }
                        }
                        
                    }
                }

            }
            
        }
	        
        event(new BreadDataAdded($dataType, $data));

        return redirect()
        ->route("voyager.{$dataType->slug}.index")
        ->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
    }

    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $request = $request;

        if($request["general_image"] == "[]"){
            $request["general_image"] = "";
        }

        if($request["general_image"] == null){
            $request["image_type"] = "attr";
        }else{
            $request["image_type"] = "general";
        }

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);


        if(setting('site.xd_software')){

            if($request["general_image"] == null){
                foreach ($request["idAtribute"] as $keyId => $valueIdAtribute) {
                    foreach ($request["valueAtribute"] as $keyValue => $valueAtribute) {
                        if($keyId == $keyValue){
                            $attrImage = ItemsAttrImage::where("items_id", $id)->where("attr_id", json_decode($request["optradio"])->Id)->where("id_attr", $valueIdAtribute)->first();
                            $attrImage->items_id = $id;
                            $attrImage->attr_id = json_decode($request["optradio"])->Id;
                            $attrImage->id_attr = $valueIdAtribute;
                            $attrImage->name_attr = $valueAtribute;
                            $attrImage->images_attr = $request["images_attr_$keyId"];
                            $attrImage->save();
                        }
                    }
                }
            }

        }else{

            ItemsAttrImage::where("items_id", $id)->delete();

            if($request["general_image"] == ""){

                $request["nao_sei"] = $request["nao_sei"] - 1;

                for ($i=0; $i <= $request["nao_sei"]; $i++) { 
                    foreach($request["attr_" . $i] as $keyAttr => $valueAttr){
                        foreach($request["preco_" . $i] as $keyPreco => $valuePreco){
                            if($keyAttr == $keyPreco){
                                $attrImage = new ItemsAttrImage();
                                $attrImage->items_id = $data->id;
                                $attrImage->attr_id = $i;
                                $attrImage->id_attr = $keyAttr;
                                $attrImage->name_attr = $valueAttr;
                                $attrImage->images_attr = $request["images_attr_" . $i . "_" . $keyAttr];
                                $attrImage->price = $valuePreco;
                                $attrImage->attr_id_name = $request["name_attr_" . $i];
                                if($request["stock_" . $i] == "on"){
                                    $attrImage->stock = "Sim";
                                }else{
                                    $attrImage->stock = "Não";
                                }
                                $attrImage->save();
                            }
                        }
                        
                    }
                }

            }
            
        }

        event(new BreadDataUpdated($dataType, $data));

        return redirect()
        ->route("voyager.{$dataType->slug}.index")
        ->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }
}
