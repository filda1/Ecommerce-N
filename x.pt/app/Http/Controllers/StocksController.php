<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsAttrImage;

class StocksController extends Controller
{
    public function searchAttr(Request $request){
    	$attr = ItemsAttrImage::where("items_id", $request["item_id"])->where("stock", "Sim")->get();

    	$resultados = array();

	    foreach ($attr as $value) {

	        if (isset($resultados[$value->attr_id])) {
	            $index = count($resultados[$value->attr_id]);
	        }else{
	            $index = 0;
	        }

	        $resultados[$value->attr_id][$index] = $value;

	    }

    	return view("stocks.item_attrs", compact("resultados"));
    }
}
