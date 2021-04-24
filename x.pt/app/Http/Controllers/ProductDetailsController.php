<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Item;
use App\XDHelper;
use App\ItemsAttrImage;
use App\Stock;

class ProductDetailsController extends Controller
{
    public function index(Request $request){
    	$isAjax = false;
      	if (strpos($request->fullUrl(), 'ajax') !== false) {
			$isAjax = true;
		}

		$item = Item::find($request->id);

		$atributesImages = ItemsAttrImage::where('items_id', $request->id)->get();
		$atributesImagesParsed = array();
		$attributeImageControlerID = null;

		if(setting('site.xd_software')){

			foreach ($atributesImages as $key => $attributeImage) {
				$attributeImageKey = "{".$attributeImage->attr_id.",".$attributeImage->id_attr."}";

				$atributesImagesParsed[$attributeImageKey] = json_decode($attributeImage->images_attr, true);
				$attributeImageControlerID = $attributeImage->attr_id;
			}

		}else{

			foreach ($atributesImages as $key => $attributeImage) {

				$attributeImageKey = "{".$attributeImage->attr_id.",".$attributeImage->id_attr."}";

				$atributesImagesParsed[$attributeImageKey] = json_decode($attributeImage->images_attr, true);
				$attributeImageControlerID = $attributeImage->attr_id;
			}

		}

		$info = "action=items&ids=" . $item->xd_id . "&with=ShortName1,Description,AttributeInfo,RetailPrice1";

      	$xdcontroller = new XDHelper();

		if(setting('site.xd_software')){
			$itemInfo = $xdcontroller->makeRequest($info);
			if(isset($itemInfo["result"]["error"])){
				return returnErrorView();
			}
		}else{

			if($item->image_type == "attr"){

				$attrs_price = ItemsAttrImage::where('items_id', $request->id)->where("price", "!=", NULL)->get()->toArray();

				$attrs = ItemsAttrImage::where('items_id', $request->id)->get()->toArray();

				foreach ($attrs as $value) {

			        if (isset($itemInfo[$value["items_id"]])) {
			            $index = count($itemInfo[$value["items_id"]]);
			        }else{
			            $index = 0;
			        }

			        $itemInfo[$value["items_id"]][$index] = $value;

			    }

			    $item_price = null;

			}else{

				$attrs = null;

				$attrs_price = null;

				if (isset($itemInfo[$item->id])) {
		            $index = count($itemInfo[$item->id]);
		        }else{
		            $index = 0;
		        }

				$itemInfo[$item->id][$index] = $item;

				$item_price = $item->price;

			}

			$stock = Stock::where("items_id", $item->id)->get()->toArray();

			foreach ($stock as $value) {

				$attr = preg_split('/[;}{]/', $value["attr_ids"]);

                $attr_corrects = array_filter($attr);

				$name = getNameAttrByIdsAttrs($value["items_id"], $attr_corrects);

		        if (isset($stocks[$name])) {
		            $index = count($stocks[$name]);
		        }else{
		            $index = 0;
		        }

		        $stocks[$name][$index] = $value;

		    }

		    $entrada = "";

		    $saida = "";

		    if($stock != []){
		    	foreach ($stocks as $key => $values) {

					foreach ($values as $value) {

						if($value["type"] == "entrada"){
							if($entrada == ""){
								$entrada = $value["stock"];
							}else{
								$entrada = $value["stock"] + $entrada;
							}
						}else{
							if($saida == ""){
								$saida = $value["stock"];
							}else{
								$saida = $value["stock"] + $saida;
							}
						}

					}

					$stockss = array();

					if($saida != ""){
						$total = $entrada - $saida;

						$stockss[$key] = $total;

						array_push($stockss, $stocks[$key]);
					}

				}
		    }else{
		    	$stockss = "";
		    }

			$items_attrs = ItemsAttrImage::where('items_id', $request->id)->get()->toArray();

		    $attr_category = array();

		    foreach ($items_attrs as $value) {

		        if (isset($attr_category[$value["attr_id_name"]])) {
		            $index = count($attr_category[$value["attr_id_name"]]);
		        }else{
		            $index = 0;
		        }

		        $attr_category[$value["attr_id_name"]][$index] = $value;

		    }

		}

		if(setting('site.xd_software')){
			$comparate = "!=";
		}else{
			$comparate = "=";
		}

		//Items Relacionados
		$itemsRelated = DB::table('items')->where("xd_id", $comparate, NULL)->inRandomOrder()->take(6)->get();

      	/*$itemsXDIDs = $itemsRelated->pluck('xd_id')->unique()->implode(',');

      	$info = "action=items&ids=" . $itemsXDIDs . "&with=ShortName1,Description,AttributeInfo,RetailPrice1";

		$itemInfoRelated = $xdcontroller->makeRequest($info);

		if(isset($itemInfoRelated["result"]["error"])){
			return returnErrorView();
		}

		$itemsPricesRelated = array();

		foreach ($itemInfoRelated["result"] as $key => $itemRelated) {
			if($itemRelated["AttributeInfo"]["Prices"] != null){
				//ONLY GET BASE VALUE, SO WE CAN GET THE FIRST PRICE
				$itemsPricesRelated[$key] = $itemRelated["AttributeInfo"]["Prices"][0]["Price1"]["TaxIncludedPrice"];
			}else{
				$itemsPricesRelated[$key] = $itemRelated["RetailPrice1"];
			}
		}

		return view('item-detail', compact('isAjax', 'item', 'itemInfo', 'atributesImagesParsed', 'attributeImageControlerID', 'itemsRelated', 'itemsPricesRelated'));*/
		if(setting('site.xd_software')){
			return view('item-detail', compact('isAjax', 'item', 'itemInfo', 'atributesImagesParsed', 'attributeImageControlerID', 'itemsRelated'));
		}else{
			return view('item-detail', compact('isAjax', 'item', 'itemInfo', 'atributesImagesParsed', 'attributeImageControlerID', 'itemsRelated', 'stock', 'stockss', 'attr_category', 'attrs', 'attrs_price', 'item_price'));
		}
    }
}
