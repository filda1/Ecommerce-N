<?php

use App\ItemsAttrImage;
use App\BannerPublicitario;
use App\Familia;
use App\Contacto;
use App\Item;
use App\Stock;
use App\User;
use App\AdressesUser;
use App\OrderState;
use App\State;
use App\Config;
use App\Order;
use App\Country;

function showStartSetup(){
    $showStartSetup = true;

    $user = User::find(Auth::user()->id);

    if($user->has_finish_setup == 1){
        $showStartSetup = false;
    }

    return $showStartSetup;
}

function getAddressById($id){
    return AdressesUser::find($id);
}

function getStateByOrderId($id){
    return State::find($id);
}

function background_URL($url){
   $url = url($url);
   $url = str_replace("\\", "/", $url);

   return $url;
}

function getImageAttrByItem($id){
	
	$image_attr = ItemsAttrImage::where("items_id", $id)->get();

	return $image_attr;
}

function getBanners(){
	return BannerPublicitario::where("ativo", 1)->get();
}

function getAllTypesOfItems(){
	return Familia::all();
}

function getContactDetails(){
	return Contacto::first();
}

function returnErrorView(){
	return '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Server Error</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: \'Nunito\', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                500            </div>

            <div class="message" style="padding: 10px;">
                Opps... Please refresh the page to try again...            </div>
        </div>
    </body>
</html>';
}

function getNameAttrAndNameAttrValue($item_id, $id_attr, $id_attr_value, $attr){
    foreach ($attr as $value) {
        if ($value["Id"] == $id_attr) {
            foreach($value["Values"] as $values){
                if ($values["Id"] == $id_attr_value) {
                    return ["Attr" => $value["Name"], "Attr_Value" => $values["Value"]];
                }
            }
        }
    }
}

function getNameItemById($items_id){
    return Item::find($items_id)->name;
}

function getAttrByItemId($items_id){
    $attrs = ItemsAttrImage::where("items_id", $items_id)->get();

    $resultados = array();

    foreach ($attrs as $value) {

        if (isset($resultados[$value->attr_id])) {
            $index = count($resultados[$value->attr_id]);
        }else{
            $index = 0;
        }

        $resultados[$value->attr_id][$index] = $value;

    }

    return $resultados;
}

function getNameAttrByIdsAttrs($item_id, $attrs_ids){
    $name = "";
    foreach ($attrs_ids as $key => $value) {
        $attr_ids = explode(',', $value);
        $attr_id = $attr_ids[0];
        $id_attr = $attr_ids[1];
        $item_attr = ItemsAttrImage::where("items_id", $item_id)->where("attr_id", $attr_id)->where("id_attr", $id_attr)->first();
        if($name == ""){
            $name = $item_attr["name_attr"];
        }else{
            $name = $item_attr["name_attr"] . ", " . $name;
        }
    }

    return $name;
}

function getStateColorByOrderId($id){
    $order_state = OrderState::where("order_id", $id)->where("active", 1)->first();

    $state = State::find($order_state->state_id);

    if($state->id == "1"){
        return "primary";
    }elseif ($state->id == "2") {
        return "warning";
    }elseif ($state->id == "3") {
        return "success";
    }else{
        return "default";
    }
}

function checkPlan(){
    return Config::first()->plan;
}

function checkPlanIsFree(){
    return Config::first()->plan_free;
}

function getOrder(){
    return Order::whereIn("order_state", [1,2])->get();
}

function getUserTwo(){
    return User::where("id", 2)->first();
}

function checkUserEndereco(){
    if(!Auth::check()){
        return;
    }
    
    $u = User::where('id', \Auth::user()->id)->first();

    $endereco_user_id = AdressesUser::where('user_id', $u->id)->where('is_active', 1)->where('is_main', 1)->first();

    if($endereco_user_id == ""){
        return "error_endereco";
    }
}

function getCountryName($id){
    return Country::find($id)->name;
}