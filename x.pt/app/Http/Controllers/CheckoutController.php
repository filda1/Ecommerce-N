<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\TransportCategory;
use App\TransportCost;
use App\Country;
use App\User;
use App\AdressesUser;
use DB;
use Auth;
use Session;
use Redirect;

class CheckoutController extends Controller
{
    public function index(Request $request){
		$isAjax = false;
      	if (strpos($request->fullUrl(), 'ajax') !== false) {
			$isAjax = true;		    
		}

		$enderecos = AdressesUser::where('user_id', Auth::user()->id)->where('is_main', 1)->first();
		$country = $enderecos->country;
		
		$distrit = Country::where('name', $country)->first();
		$id_distrit = $distrit->id;
		
		$state= $distrit->country;
		
      
       /* $cost1 = DB::table('transport_costs')
            ->join('transport_categories', 'transport_costs.country_id', '=', 'transport_categories.id')
            ->where('deleted_at', '=', "")
            ->select()
            ->get();
        
         $cost= $cost1[0]->desc;*/
         
         
         
         $cost = DB::table('transport_costs')
                  ->join('transport_categories', function($join)
                {
                    $join->on('transport_costs.country_id', '=', 'transport_categories.id')
                         ->where('transport_costs.deleted_at', '=', null);
                })
                ->Select()
                ->get();
        
     
        
       
        foreach ($cost as $c1) {
       
           if($c1->price == 0){
               
               $zero= "true";
                break;
	       }
	       else
	       {
	           $zero= "false";
	            break;
	       }
        }




		return view('cart', compact('isAjax','cost', 'country', 'zero'));
      
	
	}



	public function checkAvailableTransportOptions(Request $request){
		if(!Auth::check()){
	        return ["status"=>"error_login"];
	      
	    }
	    
	    
	    $u = User::where('id', \Auth::user()->id)->first();

	    $endereco_user_id = AdressesUser::where('user_id', $u->id)->where('is_active', 1)->where('is_main', 1)->first();

	    if($endereco_user_id == ""){
	        return ["status"=>"error_endereco"];
	    }

		$items_ids = explode(",", $request->items_ids);

		$country = Country::where("name", $endereco_user_id->country)->first();

		$transport_category_ids = Item::whereIn('id', $items_ids)->pluck('transport_category_id')->toArray();

		$transport_category_id = TransportCategory::whereIn('id', $transport_category_ids)->orderBy('order', 'desc')->first()->id;
		
		$transport_costs = TransportCost::where('transport_categories', $transport_category_id)->where("country_id", $country->id)->get();
		
		$transport_costs = TransportCost::where("country_id", $country->id)->get();

     	foreach ($transport_costs as $key => $transport_cost) {
			$country_name = Country::find($transport_cost->country_id)->name;

			$transport_cost->country_name = $country_name;
		} 

        
		return ["status"=>"ok", "result"=>$transport_costs];
	
	}
}
