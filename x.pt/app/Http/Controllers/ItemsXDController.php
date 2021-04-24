<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\XDHelper;
use App\Item;

class ItemsXDController extends Controller
{
    public function checkReference($reference){

		$info = "action=items&ids=" . $reference . "&with=ShortName1,Description,AttributeInfo,RetailPrice1,RetailPrice2,RetailPrice3,RetailPrice4,RetailPrice5";

        $xdcontroller = new XDHelper();
		$itemInfo = $xdcontroller->makeRequest($info);

		$attributesHTML = null;

		if(!isset($itemInfo["result"]["error"])){

			if($itemInfo["result"][$reference]["AttributeInfo"]["StockAttributes"] == []){
				$attributesHTML = null;
			}else{
				$attributeInfo = $itemInfo["result"][$reference]["AttributeInfo"]["StockAttributes"];

        		$attributesHTML = view('items.atributes', compact('attributeInfo'))->render();
			}
		}

        return ["itemInfo" => $itemInfo, "attributesHTML" => $attributesHTML];

    }

    public function viewAtributes($atributes){

    	$atributeValues = json_decode($atributes);

    	$atribute = $atributeValues->Values;

    	return view('items.atributesdetails', compact('atribute'));

    }

    public function generalImage(){
    	return view('items.multiple_images');
    }

    //Promotions

    public function searchValue(Request $request){
        $item = Item::find($request->item_id);

        return $this->checkReference($item->xd_id);
    }

    public function postValue(Request $request){
        $item = Item::find($request->item_id);
        $price_value = $item->pvp;
        $values = $request["values"]["result"][$item->xd_id]["AttributeInfo"];
        return view('promotions.values', compact('values', 'price_value'));
    }

    public function postValueNoAttr(Request $request){
        $item = Item::find($request->item_id);
        if($item->pvp == "Price1"){
            $price_value = "RetailPrice1";
        }elseif ($item->pvp == "Price2") {
            $price_value = "RetailPrice2";
        }elseif ($item->pvp == "Price3") {
            $price_value = "RetailPrice3";
        }elseif ($item->pvp == "Price4") {
            $price_value = "RetailPrice4";
        }elseif ($item->pvp == "Price5") {
            $price_value = "RetailPrice5";
        }
        $values = $request["values"]["result"][$item->xd_id];
        return view('promotions.values_noattr', compact('values', 'price_value'));
    }

    public function calculatePercentageWithValue(Request $request){
        $value_origin = $request->value_origin;

        $value = $request->value;

        $percentage = ($value / $value_origin) * 100;

        $value_end = $value_origin - $request->value;

        $percentage = number_format($percentage, 2, '.', '');

        $value_end = number_format($value_end, 2, '.', '');

        return ["percentage" => $percentage, "value_end" => $value_end];
    }

    public function calculatePercentageWithPercentage(Request $request){
        $percentage = $request->percentage / 100;

        $value_origin = $request->value_origin;

        $value = $percentage * $value_origin;

        $value_end = $value_origin - $value;

        $value = number_format($value, 2, '.', '');

        $value_end = number_format($value_end, 2, '.', '');

        return ["value" => $value, "value_end" => $value_end];
    }

    public function calculatePercentageWithValueEnd(Request $request){
        $value_origin = $request->value_origin;

        $value_end = $request->value_end;

        $value = $value_origin - $value_end;

        $percentage = ($value / $value_origin) * 100;

        $value = number_format($value, 2, '.', '');

        $percentage = number_format($percentage, 2, '.', '');

        return ["percentage" => $percentage, "value" => $value];
    }

    public function addOtherAttr($id){
        return view('items.add_attr', compact("id"));
    }

    public function addOtherAttrInAttr($id, $imagem){
        return view('items.add_attr_in_attr', compact("id", "imagem"));
    }

    public function editAttr(Request $request){
        $attr = json_decode($request["result"]);
        
        return view('items.edit_attr', compact("attr"));
    }
}
