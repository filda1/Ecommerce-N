<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\ContactUS;
use App\Contacto;
use App\Sobre;
use App\BannerPublicitario;
use App\Familia;
use App\Item;
use App\XDHelper;
use App\User;
use App\AdressesUser;
use App\ItemsAttrImage;
use App\Settings;
use App\Config;
use App\Order;
use Hash;
use Auth;
use Redirect;
use Session;

class WebSiteController extends Controller
{
    public function login(Request $request){

        $u = User::where('email', $request->email)->first();

        if(!$u){
            return ["result"=>"incorrect"];
        }else{
    		    if($u->has_finish_setup == 0)
            	return ["result"=>"blocked"];
                
                
           	if(Hash::check($request->password, $u->password)){
                $u->remember_token = Str::random(100);
                $u->save();
                $u["result"] = "success";

                Auth::loginUsingId($u->id);

                return $u;
            }else{
            	return ["result"=>"incorrect"];
            }

        }
    }

    public function teste(){
      $teste = array("AF"=> "Afghanistan",
        "AX"=> "Åland Islands",
        "AL"=> "Albania",
        "DZ"=> "Algeria",
        "AS"=> "American Samoa",
        "AD"=> "Andorra",
        "AO"=> "Angola",
        "AI"=> "Anguilla",
        "AQ"=> "Antarctica",
        "AG"=> "Antigua and Barbuda",
        "AR"=> "Argentina",
        "AM"=> "Armenia",
        "AW"=> "Aruba",
        "AU"=> "Australia",
        "AT"=> "Austria",
        "AZ"=> "Azerbaijan",
        "BS"=> "Bahamas",
        "BH"=> "Bahrain",
        "BD"=> "Bangladesh",
        "BB"=> "Barbados",
        "BY"=> "Belarus",
        "BE"=> "Belgium",
        "BZ"=> "Belize",
        "BJ"=> "Benin",
        "BM"=> "Bermuda",
        "BT"=> "Bhutan",
        "BO"=> "Bolivia, Plurinational State of",
        "BQ"=> "Bonaire, Sint Eustatius and Saba",
        "BA"=> "Bosnia and Herzegovina",
        "BW"=> "Botswana",
        "BV"=> "Bouvet Island",
        "BR"=> "Brazil",
        "IO"=> "British Indian Ocean Territory",
        "BN"=> "Brunei Darussalam",
        "BG"=> "Bulgaria",
        "BF"=> "Burkina Faso",
        "BI"=> "Burundi",
        "KH"=> "Cambodia",
        "CM"=> "Cameroon",
        "CA"=> "Canada",
        "CV"=> "Cape Verde",
        "KY"=> "Cayman Islands",
        "CF"=> "Central African Republic",
        "TD"=> "Chad",
        "CL"=> "Chile",
        "CN"=> "China",
        "CX"=> "Christmas Island",
        "CC"=> "Cocos (Keeling) Islands",
        "CO"=> "Colombia",
        "KM"=> "Comoros",
        "CG"=> "Congo",
        "CD"=> "Congo, the Democratic Republic of the",
        "CK"=> "Cook Islands",
        "CR"=> "Costa Rica",
        "CI"=> "Côte d'Ivoire",
        "HR"=> "Croatia",
        "CU"=> "Cuba",
        "CW"=> "Curaçao",
        "CY"=> "Cyprus",
        "CZ"=> "Czech Republic",
        "DK"=> "Denmark",
        "DJ"=> "Djibouti",
        "DM"=> "Dominica",
        "DO"=> "Dominican Republic",
        "EC"=> "Ecuador",
        "EG"=> "Egypt",
        "SV"=> "El Salvador",
        "GQ"=> "Equatorial Guinea",
        "ER"=> "Eritrea",
        "EE"=> "Estonia",
        "ET"=> "Ethiopia",
        "FK"=> "Falkland Islands (Malvinas)",
        "FO"=> "Faroe Islands",
        "FJ"=> "Fiji",
        "FI"=> "Finland",
        "FR"=> "France",
        "GF"=> "French Guiana",
        "PF"=> "French Polynesia",
        "TF"=> "French Southern Territories",
        "GA"=> "Gabon",
        "GM"=> "Gambia",
        "GE"=> "Georgia",
        "DE"=> "Germany",
        "GH"=> "Ghana",
        "GI"=> "Gibraltar",
        "GR"=> "Greece",
        "GL"=> "Greenland",
        "GD"=> "Grenada",
        "GP"=> "Guadeloupe",
        "GU"=> "Guam",
        "GT"=> "Guatemala",
        "GG"=> "Guernsey",
        "GN"=> "Guinea",
        "GW"=> "Guinea-Bissau",
        "GY"=> "Guyana",
        "HT"=> "Haiti",
        "HM"=> "Heard Island and McDonald Islands",
        "VA"=> "Holy See (Vatican City State)",
        "HN"=> "Honduras",
        "HK"=> "Hong Kong",
        "HU"=> "Hungary",
        "IS"=> "Iceland",
        "IL"=> "Israel",
        "IT"=> "Italy",
        "JM"=> "Jamaica",
        "JP"=> "Japan",
        "JE"=> "Jersey",
        "JO"=> "Jordan",
        "KZ"=> "Kazakhstan",
        "KE"=> "Kenya",
        "KI"=> "Kiribati",
        "KP"=> "Korea, Democratic People's Republic of",
        "KR"=> "Korea, Republic of",
        "KW"=> "Kuwait",
        "KG"=> "Kyrgyzstan",
        "LA"=> "Lao People's Democratic Republic",
        "LV"=> "Latvia",
        "LB"=> "Lebanon",
        "LS"=> "Lesotho",
        "LR"=> "Liberia",
        "LY"=> "Libya",
        "LI"=> "Liechtenstein",
        "LT"=> "Lithuania",
        "LU"=> "Luxembourg",
        "MO"=> "Macao",
        "MK"=> "Macedonia, the former Yugoslav Republic of",
        "MG"=> "Madagascar",
        "MW"=> "Malawi",
        "MY"=> "Malaysia",
        "MV"=> "Maldives",
        "ML"=> "Mali",
        "MT"=> "Malta",
        "MH"=> "Marshall Islands",
        "MQ"=> "Martinique",
        "MR"=> "Mauritania",
        "MU"=> "Mauritius",
        "YT"=> "Mayotte",
        "MX"=> "Mexico",
        "FM"=> "Micronesia, Federated States of",
        "MD"=> "Moldova, Republic of",
        "MC"=> "Monaco",
        "MN"=> "Mongolia",
        "ME"=> "Montenegro",
        "MS"=> "Montserrat",
        "MA"=> "Morocco",
        "MZ"=> "Mozambique",
        "MM"=> "Myanmar",
        "NA"=> "Namibia",
        "NR"=> "Nauru",
        "NP"=> "Nepal",
        "NL"=> "Netherlands",
        "NC"=> "New Caledonia",
        "NZ"=> "New Zealand",
        "NI"=> "Nicaragua",
        "NE"=> "Niger",
        "NG"=> "Nigeria",
        "NU"=> "Niue",
        "NF"=> "Norfolk Island",
        "MP"=> "Northern Mariana Islands",
        "NO"=> "Norway",
        "OM"=> "Oman",
        "PK"=> "Pakistan",
        "PW"=> "Palau",
        "PS"=> "Palestinian Territory, Occupied",
        "PA"=> "Panama",
        "PG"=> "Papua New Guinea",
        "PY"=> "Paraguay",
        "PE"=> "Peru",
        "PH"=> "Philippines",
        "PN"=> "Pitcairn",
        "PL"=> "Poland",
        "PT"=> "Portugal",
        "PR"=> "Puerto Rico",
        "QA"=> "Qatar",
        "RE"=> "Réunion",
        "RO"=> "Romania",
        "RU"=> "Russian Federation",
        "RW"=> "Rwanda",
        "BL"=> "Saint Barthélemy",
        "SH"=> "Saint Helena, Ascension and Tristan da Cunha",
        "KN"=> "Saint Kitts and Nevis",
        "LC"=> "Saint Lucia",
        "MF"=> "Saint Martin (French part)",
        "PM"=> "Saint Pierre and Miquelon",
        "VC"=> "Saint Vincent and the Grenadines",
        "WS"=> "Samoa",
        "SM"=> "San Marino",
        "ST"=> "Sao Tome and Principe",
        "SA"=> "Saudi Arabia",
        "SN"=> "Senegal",
        "RS"=> "Serbia",
        "SC"=> "Seychelles",
        "SL"=> "Sierra Leone",
        "SG"=> "Singapore",
        "SX"=> "Sint Maarten (Dutch part)",
        "SK"=> "Slovakia",
        "SI"=> "Slovenia",
        "SB"=> "Solomon Islands",
        "SO"=> "Somalia",
        "ZA"=> "South Africa",
        "GS"=> "South Georgia and the South Sandwich Islands",
        "SS"=> "South Sudan",
        "ES"=> "Spain",
        "LK"=> "Sri Lanka",
        "SD"=> "Sudan",
        "SR"=> "Suriname",
        "SJ"=> "Svalbard and Jan Mayen",
        "SZ"=> "Swaziland",
        "SE"=> "Sweden",
        "CH"=> "Switzerland",
        "SY"=> "Syrian Arab Republic",
        "TW"=> "Taiwan, Province of China",
        "TJ"=> "Tajikistan",
        "TZ"=> "Tanzania, United Republic of",
        "TH"=> "Thailand",
        "TL"=> "Timor-Leste",
        "TG"=> "Togo",
        "TK"=> "Tokelau",
        "TO"=> "Tonga",
        "TT"=> "Trinidad and Tobago",
        "TN"=> "Tunisia",
        "TR"=> "Turkey",
        "TM"=> "Turkmenistan",
        "TC"=> "Turks and Caicos Islands",
        "TV"=> "Tuvalu",
        "UG"=> "Uganda",
        "UA"=> "Ukraine",
        "AE"=> "United Arab Emirates",
        "GB"=> "United Kingdom",
        "US"=> "United States",
        "UM"=> "United States Minor Outlying Islands",
        "UY"=> "Uruguay",
        "UZ"=> "Uzbekistan",
        "VU"=> "Vanuatu",
        "VE"=> "Venezuela, Bolivarian Republic of",
        "VN"=> "Viet Nam",
        "VG"=> "Virgin Islands, British",
        "VI"=> "Virgin Islands, U.S.",
        "WF"=> "Wallis and Futuna",
        "EH"=> "Western Sahara",
        "YE"=> "Yemen",
        "ZM"=> "Zambia",
        "ZW"=> "Zimbabwe");
        
        $array = "";
        foreach ($teste as $key => $value) {
          if($array == ""){
            $array = "else if(name_country == '" . $key . "'){
                name = '" . $value . "';
            }";
          }else{
            $array = $array . "else if(name_country == '" . $key . "'){
                name = '" . $value . "';
            }";
          }
          
        }

        dd($array);
    }

    public function confirmarConta($token){
        $u = User::where('token_confirmation', $token)->first();

        if($u == null)
         abort(403, "Endereço de confirmação expirado.");

        if($u->has_finish_setup == "1"){
           abort(403, "Este endereço de email já foi confirmado.");
        }else{
          $u->token_confirmation = "";
          $u->has_finish_setup = 1;
          $u->save();
        }

        Session::flash('info', 'O seu email foi confirmado.');
        return redirect('/');
    }

    public function saveRegister(Request $request){
      $token = str_replace('/', '_', str_replace('.', '0', Hash::make($request->remail."*".Carbon::now())));

      //Criar Utilizador
      $user = new User();
      $user->role_id = 2;
      $user->name = $request->rname;
      $user->email = $request->remail;
      $user->password = bcrypt($request->rpassword);
      $user->token_confirmation = $token;
      $user->save();

 
      \Mail::send('mail.contact', array(
         'nome' => $request->rname,
         'email' => $request->remail,
         'token' => $token
      ), function ($message) use ($request){
          $message->to($request->remail)->subject("Confirmação de Email");
          $message->from(config('mail.username'));
      });

      Session::flash('info', 'Foi lhe enviado um email para confirmação.');
      return redirect()->back();
    }

    public function checkEmail($email){
        $u = User::where('email', $email)->first();

        if($u){
          return "error";
        }
    }

    /*public function profile(Request $request){
    	$u = User::where('email', $request->email)->first();

        if(!$u){
            return ["result"=>"incorrect"];
        }else{
    		if($u->ativada == "não")
            	return ["result"=>"blocked"];
            
           	if(Hash::check($request->password, $u->password)){
                $u->remember_token = str_random(100);
                $u->save();
                $u["result"] = "success";

                return view("users.profile", compact("u"));
            }else{
            	return ["result"=>"incorrect"];
            }

        }
    }*/

    public function profileEditSave(Request $request){
    	$u = User::where('email', $request->email_original)->first();

        if(!$u){
            return ["result"=>"incorrect_email"];
        }

       	if(Hash::check($request->password, $u->password)){
       		$u->name = $request->name;
       		$u->email = $request->email;
       		$u->password = Hash::make($request->password_new);
            $u->save();

            return ["result"=>"success"];
        }else{
        	return ["result"=>"incorrect_password"];
        }

    }

    public function adressSave(Request $request){
      $adress = new AdressesUser();
      $adress->user_id = $request["user_id"];
      $adress->number = $request["number"];
      $adress->country = $request["country"];
      $adress->locality = $request["locality"];
      $adress->zip_code = $request["zip_code"];
      $adress->street = $request["street"];
      $adress->is_active = "1";
      $adress->is_main = "0";
      $adress->save();

      return ["result"=>"success"];
    }

    public function updateAdress($id){
    /*  $enderecos = AdressesUser::where('user_id', Auth::user()->id)->where('is_main', 1)->first();
      if($enderecos != "[]"){
        $enderecos->is_main = 0;
        $enderecos->save();
      }
          $enderecos = AdressesUser::find($id);
              $enderecos->is_main = 1;
              $enderecos->save();
     */
      
   
                 $en =  AdressesUser::where('user_id', Auth::user()->id)->where('is_main', 1)->first();
                     
                           //($en->is_main ==1 )
                            if( isset($en) )
                           {
                              $en = AdressesUser::find($en->id);
                              $en->is_main = 0;
                              //$en->is_active = 0;
                              $en->save();
                        
                           }
                           else
                            {
                          
                            }
                           
                     
                      $enderecos = AdressesUser::where('user_id', Auth::user()->id)->where('is_main', 1)->first();
                   
                      try {
                              $enderecos = AdressesUser::find($id);
                              $enderecos->is_main = 1;
                              //$enderecos->is_active = 1;
                              $enderecos->save();
                           }
                     catch (Exception $e) {
                             $enderecos->is_main = 0;
                             //$enderecos->is_active = 0;
                             $enderecos->save();
                           } 
           
           

      return;
    }
    

    public function removeAdress($id){
      $enderecos = AdressesUser::where("id", $id)->first();
      $enderecos->is_active = 0;
      $enderecos->save();

      return ["result"=>"success"];
    }

    public function logout(){
    	Auth::logout();

    	return redirect('/');
    }

    public function fullProfile(Request $request){
   		$isAjax = false;
      	if (strpos($request->fullUrl(), 'ajax') !== false) {
			$isAjax = true;		    
		}

		$date = Carbon::now();

		$config = Config::first();

		if($config->plan_free == "Sim"){
			if ($config->plan_end >= $date) {
				if(!Auth::check()){
					abort(403, "Este website encontra-se em manutenção.");
				}
			}else{
				abort(403, "Este website encontra-se em manutenção.");
			}
		}else{
			if ($config->plan_end <= $date) {
				abort(403, "Este website encontra-se em manutenção.");
			}
		}

      	$contacto = Contacto::first();

        if(Auth::check()){
          $user_id = Auth::user()->id;
          $adresses = AdressesUser::where("user_id", $user_id)->where("is_active", "1")->get();
        }


      	if(Auth::check()){
      		return view('users.full_profile', compact('isAjax', 'contacto', 'adresses'));
      	}else{
      		return redirect('/');
      	}

   	}

	public function index(Request $request){
		$isAjax = false;
    	if (strpos($request->fullUrl(), 'ajax') !== false) {
  			$isAjax = true;
  		}

  		$date = Carbon::now();

  		$config = Config::first();

  		if($config->plan == "Free"){
  			if ($config->plan_end >= $date) {
  				if(!Auth::check()){
  					abort(403, "Este website encontra-se em manutenção.");
  				}
  			}else{
  				abort(403, "Este website encontra-se em manutenção.");
  			}
  		}else{
  			if ($config->plan_end <= $date) {
  				abort(403, "Este website encontra-se em manutenção.");
  			}
  		}

		
		$itemsPrices = array();

		if(isset($request->categoria)){
			if($request->categoria == "all"){
				$familyIDS = Familia::get()->toArray();
			}else{
				$familyIDS[0] = $request->categoria;
			}
		}else{
      if(setting('site.xd_software')){
        $familyIDS = Familia::get()->toArray();
      }else{
        $familyIDS = Familia::get()->pluck("id")->toArray();
      }
		}

    $comparator = "=";

    if(setting('site.xd_software'))
      $comparator = "!=";

		//PROBABLY NEEDS BETTER SOLUTION
		if(isset($request->search) && $request->search != ""){
  			$items = Item::where("name", $request->search)->whereIn('familia_id', $familyIDS)->where("xd_id", $comparator, NULL)->paginate(Item::count())->appends(['type' => 'ajax']);
		}else{
			if(!isset($request->enable_filter)){
  			$items = Item::whereIn('familia_id', $familyIDS)->where("xd_id", $comparator, NULL)->paginate(9)->appends(['type' => 'ajax']);
			}else{
    		$items = Item::whereIn('familia_id', $familyIDS)->where("xd_id", $comparator, NULL)->paginate(Item::count())->appends(['type' => 'ajax']);
    	}
		}

    if(setting('site.xd_software')){
      if($items->total() <= 0)
        return view('items-list', compact('isAjax', 'items', 'itemsPrices'));

      $itemsXDIDs = $items->pluck('xd_id')->unique()->implode(',');

      $info = "action=items&ids=" . $itemsXDIDs . "&with=ShortName1,Description,AttributeInfo,RetailPrice1";

      $xdcontroller = new XDHelper();
      
      $itemInfo = $xdcontroller->makeRequest($info);

  		if(isset($itemInfo["result"]["error"])){
  			return returnErrorView();
  		}

      foreach ($itemInfo["result"] as $key => $item) {
        if($item["AttributeInfo"]["Prices"] != null){
          //ONLY GET BASE VALUE, SO WE CAN GET THE FIRST PRICE
          $itemsPrices[$key] = $item["AttributeInfo"]["Prices"][0]["Price1"]["TaxIncludedPrice"];
        }else{
          $itemsPrices[$key] = $item["RetailPrice1"];
        }
      }
    }else{

      foreach ($items->toArray()["data"] as $value) {

        if($value["image_type"] == "attr"){

          $attr = ItemsAttrImage::whereIn("items_id", $items)->where("price", "!=", null)->get()->toArray();
dd( $attr  );
          $numbers = array_column($attr, 'price');
          
           $min = min($numbers);

          foreach ($attr as $item) {
            $item_name = Item::where('id', $item["items_id"])->get()->toArray();
            $item_name = $item_name[0];
            if (isset($itemsPrices[$item_name["name"]])) {
                $index = $itemsPrices[$item_name["name"]];
            }else{
                $index = 0;
            }
            $itemsPrices[$item_name["name"]] = $min;
          }

        }else{

          $itemsPrices[$value["name"]] = $value["price"];

        }
      }
    }

		return view('items-list', compact('isAjax', 'items', 'itemsPrices'));
	}

  public function aboutUs(Request $request){
		$isAjax = false;
	  	if (strpos($request->fullUrl(), 'ajax') !== false) {
			$isAjax = true;		    
		}

		$date = Carbon::now();

		$config = Config::first();

		if($config->plan == "Free"){
			if ($config->plan_end >= $date) {
				if(!Auth::check()){
					abort(403, "Este website encontra-se em manutenção.");
				}
			}else{
				abort(403, "Este website encontra-se em manutenção.");
			}
		}else{
			if ($config->plan_end <= $date) {
				abort(403, "Este website encontra-se em manutenção.");
			}
		}

	  	$sobre = Sobre::first();
	  	$contacto = Contacto::first();


	  	return view('sobre', compact('isAjax', 'sobre', 'contacto'));
 	}

  public function orders(Request $request){
    $isAjax = false;
    if (strpos($request->fullUrl(), 'ajax') !== false) {
      $isAjax = true;       
    }

    $date = Carbon::now();

    $config = Config::first();

    if($config->plan_free == "Sim"){
      if ($config->plan_end >= $date) {
        if(!Auth::check()){
          abort(403, "Este website encontra-se em manutenção.");
        }
      }else{
        abort(403, "Este website encontra-se em manutenção.");
      }
    }else{
      if ($config->plan_end <= $date) {
        abort(403, "Este website encontra-se em manutenção.");
      }
    }

    if(Auth::check()){
      $user_id = Auth::user()->id;
      $orders = Order::where("user_id", $user_id)->get();

      return view('users.orders', compact('isAjax', 'orders'));
    }else{
      return redirect('/');
    }
  }

  public function legal(Request $request){
    $isAjax = false;
    if (strpos($request->fullUrl(), 'ajax') !== false) {
      $isAjax = true;       
    }

    $date = Carbon::now();

	$config = Config::first();

	if($config->plan == "Free"){
		if ($config->plan_end >= $date) {
			if(!Auth::check()){
				abort(403, "Este website encontra-se em manutenção.");
			}
		}else{
			abort(403, "Este website encontra-se em manutenção.");
		}
	}else{
		if ($config->plan_end <= $date) {
			abort(403, "Este website encontra-se em manutenção.");
		}
	}

    return view('legal', compact('isAjax'));
  }

	public function contactSaveData(Request $request){
		$this->validate($request, [
			'nome' => 'required',
			'email' => 'required|email',
			'contacto' => 'required',
			'mensagem' => 'required'
		]);

		ContactUS::create($request->all()); 

		\Mail::send('mail.contact-us',
		array(
		   'nome' => $request->get('nome'),
		   'email' => $request->get('email'),
		   'contacto' => $request->get('contacto'),
		   'user_message' => $request->get('mensagem')
		), function($message) use ($request)
		{
			$contacto = Contacto::first();
			$message->to($contacto->email, 'Admin')->subject($request->get('WebSite'));
		});

		return back()->with('success', 'Obrigado por nos contactar!'); 
   }

  public function confirmLogin($token){
    $user = User::where('domain_token', $token)->first();

    if($user == null){
      abort(403, "Seu token de Segurança, está incorreto.");
    }else{
      Auth::loginUsingId($user->id);
      return redirect('/admin');
    }
  }

  public function confirmPassword($token, $password){
    $user = User::where('domain_token', $token)->first();
    
    if($user == null){
      abort(403, "Seu token de Segurança, está incorreto.");
    }else{
      
      $user->password = $password;
      $user->save();

      Auth::loginUsingId($user->id);
      return redirect('/admin');
    }
  }

  //Backoffice
  public function saveInformation(Request $request){
    $settings = \DB::table('settings')->where('key', "site.title")->update(['value' => $request->value]);

    return ["result"=>"success"];
  }

  public function saveInformationPayTB(Request $request){
    $settings = \DB::table('settings')->where('key', "site.n_banco")->update(['value' => $request->n_banco]);

    $settings = \DB::table('settings')->where('key', "site.n_account")->update(['value' => $request->n_account]);

    $settings = \DB::table('settings')->where('key', "site.nib")->update(['value' => $request->nib]);

    $settings = \DB::table('settings')->where('key', "site.bic")->update(['value' => $request->bic]);

    return ["result"=>"success"];
  }

  public function saveInformationPayPayPal(Request $request){
    $settings = \DB::table('settings')->where('key', "site.paypal_username")->update(['value' => $request->paypal_username]);

    $settings = \DB::table('settings')->where('key', "site.paypal_password")->update(['value' => $request->paypal_password]);

    $settings = \DB::table('settings')->where('key', "site.paypal_signature")->update(['value' => $request->paypal_signature]);

    return ["result"=>"success"];
  }

  public function saveAppearance(Request $request){

    //Site Logo
    $settings = \DB::table('settings')->where('key', "site.logo")->update(['value' => $request->logo]);

    //Site Icon
    $settings = \DB::table('settings')->where('key', "site.icon")->update(['value' => $request->logo]);

    //Site Barra de Navegação
    $settings = \DB::table('settings')->where('key', "site.barra_navegacao")->update(['value' => $request->nav_color]);

    //Site Texto Barra de Navegação
    $settings = \DB::table('settings')->where('key', "site.texto_barra_navegacao")->update(['value' => $request->nav_text_color]);

    //Site Cor do Fundo do Website
    $settings = \DB::table('settings')->where('key', "site.fundo_website")->update(['value' => $request->website_background_color]);

    //Site Cor dos Títulos
    $settings = \DB::table('settings')->where('key', "site.cor_titulos")->update(['value' => $request->titles_color]);

    //Site Cor dos Textos
    $settings = \DB::table('settings')->where('key', "site.cor_textos")->update(['value' => $request->texts_color]);

    return ["result"=>"success"];

  }

  public function saveAddicionalInformation(Request $request){
    //Company Name
    $settings = \DB::table('settings')->where('key', "site.company_name")->update(['value' => $request->company_name]);

    //Company Email
    $settings = \DB::table('settings')->where('key', "site.company_email")->update(['value' => $request->company_email]);

    //Company Contact
    $settings = \DB::table('settings')->where('key', "site.company_contact")->update(['value' => $request->company_contact]);

    //Company Vat
    $settings = \DB::table('settings')->where('key', "site.company_vat")->update(['value' => $request->company_vat]);

    return ["result"=>"success"];
  }

  public function searchValue(Request $request){
    $item = Item::find($request->item_id);
    if($item->image_type == "attr"){
      $items_attrs = ItemsAttrImage::where("items_id", $request->item_id)->where("price", "!=", NULL)->get();
      return view('promotions.xdnull', compact('items_attrs'));
    }else{
      $values = $item->price;
      return view('promotions.xdnull_noattr', compact('values'));
    }
    return $item;
  }

  public function checkPlan(Request $request){
    $permission = $this->checkPermissions($request->type, $request->permission);

    if($permission["status"] != "ok"){
      return ["status" => "error", "message" => $permission["message"]];
    }

    $plan = Config::first();

    $plan->plan = $request->plan;
    $plan->plan_end = $request->end;
    $plan->plan_free = "";
    $plan->save();

    return Redirect::to("http://www.ncommerce.pt/admin/plans-users")->with(["message"=>"Pagamento feito com sucesso!", "alert-type" => "success"]);
  }

  public function checkPermissions($type, $permission){
    $permissions = [
      "edit_plan" => "paodPJFPOasdas"
    ];

    if(array_key_exists($type, $permissions)){
      if($permissions[$type] == $permission){
        return ["status" => "ok", "message" => null];
      }else{ 
        return ["status" => "error", "message" => "Permission Denied"];
      }
    }else{
      return ["status" => "error", "message" => "Permission Denied"];
    }
  }

  
}