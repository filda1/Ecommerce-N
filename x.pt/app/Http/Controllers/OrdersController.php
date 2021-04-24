<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\User;
use App\Multibanco;
use App\MBWAY;
use App\CreditCard;
use App\Order;
use App\OrderState;
use App\TransportCost;
use App\AdressesUser;
use App\Transaco;
use App\MailQueue;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\PayPal;
use Hash;
use Log;
use PDF;
use Session;
use App\Settings;
use App\Config;
use Redirect;

class OrdersController extends Controller
{
    public function new(Request $request){
       $u = User::where('id', \Auth::user()->id)->first();

        if($u == null){
            return ["result"=>"error"];
        }

        $transaction_id = rand(100000000, 999999999);

        $order = Order::where('user_id', $u->id)
                        ->whereDate('created_at', Carbon::today())
                        ->orderBy("created_at", "desc")
                        ->first();

      
        //$transport = TransportCost::find($request->transport)->price;
        $transport = 0.00;

        $cartitem = json_decode($request->cartitem, true);

        $total = "";

        foreach ($cartitem as $value) {
            for ($i=0; $i < $value["quantity"]; $i++) { 
                if($total == ""){
                    $total = $value["price"];
                }else{
                    $total = $total + $value["price"];
                }
            }
        }

        if($transport != null){
            $total = $total + $transport;
        }

        $endereco_user_id = AdressesUser::where('user_id', $u->id)->where('is_active', 1)->where('is_main', 1)->first();

        if($endereco_user_id == ""){
            return ["result" => "error_endereco"];
        }

        $order = new Order();
        $order->user_id = $u->id;
        $order->address_user_id = $endereco_user_id->id;
        $order->content = $request->cartitem;
        $order->n_order = $transaction_id;
        $order->total = $total;
        $order->type_payment = $request->pagamento;
        $order->order_state = "1";
        $order->save();

        $order = Order::where("n_order", $transaction_id)->first();
        
               /* if($request->pagamento == "tb"){
                    return ["result" => "correct", "nib" => setting('site.nib'), "bic" => setting('site.bic'), "n_account" => setting('site.n_account'), "valor" => $total, "encomenda" => $transaction_id];
                }elseif($request->pagamento == "paypal") {
                    return $this->processarPayPal($transaction_id, $total);
                }*/
        
        $numero_order=$order->n_order;
        $description = $order->content;
        $type_payment = $order->type_payment;
        
         
        $object = json_decode($description,true);
        $count = count($object);
        
        $sum ="";
        $mas =0;
         
        //Verify numero products
        for($i = 0; $i< $count; $i++)
        {
            
            $sum .= " ". $object[$i]['label']." " . "(" .$object[$i]['price'] . " € x ". $object[$i]['quantity'].")". "  " ;
            $mas += intval($object[$i]['quantity']);
        }
        
        
                    //$name =  $object[0]['label'];
                     //$qta = $object[0]['quantity'];
                     
              $name =  $sum;
                 
             $qta = strval($mas);
             $image = $object[0]['image'];
           
        
        
        if($request->pagamento == "zero"){
           return $this->Free($total, $transaction_id, $numero_order, $description, $type_payment, $name, $qta,  $image );
             
        }
          
           
          
         //////////NEW////////
       /* if($request->pagamento == "mbway"){
            return $this->checkoutMBWAY($total, $transaction_id);
        }elseif ($request->pagamento == "cc") {
            return $this->checkoutCC($total, $transaction_id, $request->numero, $request->cripto, $request->validade);
        }elseif ($request->pagamento == "multibanco") {
            return $this->checkoutMB($total, $transaction_id);
        }*/


    }

    public function transacao(Request $request){
        if($request->type_payment == "tb"){
            return Order::where('id', $request->id)->first();
        }elseif($request->type_payment == "paypal"){
            $order = Order::where('id', $request->id)->first();
            return $this->processarPayPal($order->n_order, $order->total);
        }
    }

    public function processarPayPal($id, $total){
        $paypal = new PayPal;

        $response = $paypal->purchase([
            'amount' => $paypal->formatAmount($total),
            'transactionId' => $id,
            'currency' => 'EUR',
            'cancelUrl' => $paypal->getCancelUrl(),
            'returnUrl' => $paypal->getReturnUrl($id),
        ]);

        if ($response->isRedirect()) {
            $response->redirect();
        }
    }

    public function paypalCompleted($id, Request $request)
    {

        $order = Order::where('user_id', \Auth::user()->id)
                      ->where('order_state', 1)
                      ->orderBy('created_at', 'desc')
                      ->first();

        if(!$order)
            abort(404);

        $paypal = new PayPal;

        $response = $paypal->complete([
            'amount' => $paypal->formatAmount($order->total),
            'transactionId' => $order->id,
            'currency' => 'EUR',
            'cancelUrl' => $paypal->getCancelUrl(),
            'returnUrl' => $paypal->getReturnUrl($order->id),
            'notifyUrl' => $paypal->getNotifyUrl($order->id),
        ]);

        if ($response->isSuccessful()) {
            $order->paypal_transaction_id = $response->getData()["PAYMENTINFO_0_TRANSACTIONID"];
            $order->paypal_payment_ack = $response->getData()["PAYMENTINFO_0_ACK"];
            $order->order_state = 2;
            $order->save();

            //$result = app(XDController::class)->emitirFaturaReciboEncomenda($encomenda->id);

            Session::flash('info', 'Pagamento efetuado com sucesso. Irá receber brevemente um email com mais detalhes.');
            return redirect('');
        }

    }

    public function success(Request $request){
        $identificador = $request->identificador;

        if(isset($request->token)){
            try {
                $identificador = decrypt($request->identificador);
            } catch (DecryptException $e) {
                Log::info("Paypal Decrypting Error: " + $request->identificador);
            }
        }

        $order = Order::where('n_order', '=', $identificador)->first();

        if($order->order_state == 1)
        {
            if(number_format($order->valor, 2) != number_format($request->valor, 2)){
                Log::info("Valores de encomenda e pagos não coicidem");
                abort(500);
            }

            $order->order_state = 2;
            $order->save();

            //$result = app(XDController::class)->emitirFaturaReciboEncomenda($encomenda->id);
        }
    }

    /**
     * @param $order_id
     */
    public function paypalCancelled($order_id)
    {
        return redirect()->back();
    }

    /**
     * @param $order_id
     * @param $env
     */
    public function paypalWebhook($order_id, $env)
    {
        return redirect()->back();
    }

    /*public function placeSurvey(Request $request){
        $cartitem = json_decode($request->data, true);

        $pdf = PDF::loadView('pdf.placesurvey', ['cartitem' => $cartitem]);
        return $pdf->stream('placesurvey.pdf');
    }*/

	public function checkoutMBWAY($total, $transaction_id){
        $u = User::where('id', \Auth::user()->id)->first();

        $endereco_user_id = AdressesUser::where('user_id', $u->id)->where('is_active', 1)->where('is_main', 1)->first();

        $order = Order::where("n_order", $transaction_id)->first();

        $refcompra = uniqid();
      
        $multibanco = new MBWAY;
        $result = $multibanco->gerarReferencia($u->id, env('EUPAGO_API'), $refcompra, (float) $total, $endereco_user_id->number, $order["id"]);

        if($result["result"] == "correct"){
            $order_state = new OrderState();
            $order_state->order_id = $order["id"];
            $order_state->state_id = "1";
            $order_state->active = "1";
            $order_state->save();

            $values = array();
            $values["name"] = $u->name;
            $values["message"] = "Encomenda feita com sucesso, verifique sua conta MBWay para proceder com o Pagamento.";

            $mail = new MailQueue();
            $mail->email = $u->email;
            $mail->subject = "Pagamento da Encomenda em ".setting('site.title');
            $mail->var = json_encode($values);
            $mail->view = "email.mbway";
            $mail->status = "pending";
            $mail->save();

            return ["result" => "correct"];
        }else{
            return ["result" => "error"];
        }
    }

    public function checkoutMB($total, $transaction_id){
        $u = User::where('id', \Auth::user()->id)->first();

        $endereco_user_id = AdressesUser::where('user_id', $u->id)->where('is_active', 1)->where('is_main', 1)->first();

        $order = Order::where("n_order", $transaction_id)->first();

        $refcompra = uniqid();

        $date = new Carbon();
        $date = $date->addDays(2)->format('Y-m-d');

        $multibanco = new Multibanco;
        $result = $multibanco->gerarReferencia($u->id, env('EUPAGO_API', ''), $refcompra, (float) $total, $date, $order["id"]);

        if($result["result"] == "correct"){
            $order_state = new OrderState();
            $order_state->order_id = $order["id"];
            $order_state->state_id = "1";
            $order_state->active = "1";
            $order_state->save();

            $values = array();
            $values["name"] = $u->name;
            $values["message"] = "Encomenda feita com sucesso, verifique os seguintes valores para proceder ao pagamento.";
            $values["entidade"] = $result["entidade"];
            $values["referencia"] = $result["referencia"];
            $values["valor"] = $result["valor"];

            $mail = new MailQueue();
            $mail->email = $u->email;
            $mail->subject = "Pagamento da Encomenda em ".setting('site.title');
            $mail->var = json_encode($values);
            $mail->view = "email.mb";
            $mail->status = "pending";
            $mail->save();

            return ["result" => "correct", "entidade" => $result["entidade"], "referencia" => $result["referencia"], "valor" => $result["valor"]];
        }else{
            return ["result" => "error"];
        }
    }
    
    
     public function Free($total, $transaction_id, $numero_order, $description, $type_payment, $name, $qta, $image ){
         
      
        $u = User::where('id', \Auth::user()->id)->first();
        
        $di = AdressesUser::where('user_id', \Auth::user()->id)->first();
        

        $endereco_user_id = AdressesUser::where('user_id', $u->id)->where('is_active', 1)->where('is_main', 1)->first();

        $order = Order::where("n_order", $transaction_id)->first();

        $refcompra = uniqid();

        $date = new Carbon();
        $date = $date->addDays(2)->format('Y-m-d');

       
            $order_state = new OrderState();
            $order_state->order_id = $order["id"];
            $order_state->state_id = "1";
            $order_state->active = "1";
            $order_state->save();

          
        /*    $values = array();
            $values["name"] = $u->name;
            $values["message"] = "Encomenda feita com sucesso, verifique os seguintes valores para proceder ao pagamento.";
            $values["entidade"] = "entidad";
            $values["referencia"] ="referencia";
            $values["valor"] = $result["valor"];*/

      
             // Session::flash('info', 'Foi lhe enviado um email para confirmação.');
             
             
             $semail=$u->email;
        
             $firstname= $u->name;
             $direc= $di->country.", ".$di->street. " ".$di->locality.", ".$di->zip_code;
             $tele= $di->number;
             
             $messa= "ENCOMENDA:". $numero_order. ",  ". "ARTIGO/S:" .$name. ",  " . "TRANSPORTE:Portes grátis". ",  ". "QTA:".$qta. ",  ". "ENDEREÇO:".$direc.",  "."TLF:".$tele.",  "."TOTAL:".$total." €";
             
             
             //-------------------------------------------- EMAIL CLIENTE -----------------------------------------//
             
                $data = array(
                    'name'      =>  $firstname,
                    'message'   =>  $messa,
                    'email'   =>   $semail,
                 );
    
                Mail::to($semail)->send(new SendMail($data));  
            
             //-------------------------------------------- END EMAIL CLIENTE --------------------------------------//
             
            
             //-------------------------------------------- EMAIL EMPRESA ------------------------------------------//
             
               $empresa=config('mail.username');
             
               $firstname1= "Tem novo pedido de". " ". $u->name;
               
                 $data = array(
                    'name'      =>  $firstname1,
                    'message'   =>  $messa,
                    'email'   =>   $empresa,
                 );
    
                Mail::to($empresa)->send(new SendMail($data));  
                
              //-------------------------------------------- END EMAIL EMPRESA ---------------------------------------//

          
          return ["result" => "correct", "total" => $total, "numero_order" => $numero_order,  "description"=> $description, "type_payment"=>"Portes grátis", "name"=>$name,  "qta"=>$qta, "image"=>$image];
      
    }
    
    

    public function checkoutCC($total, $transaction_id, $numero, $cripto, $validade){
        $u = User::where('id', \Auth::user()->id)->first();

        $endereco_user_id = AdressesUser::where('user_id', $u->id)->where('is_active', 1)->where('is_main', 1)->first();

        $order = Order::where("n_order", $transaction_id)->first();

        $refcompra = uniqid();

        $date = new Carbon();
        $date = $date->addDays(2)->format('Y-m-d');

        $multibanco = new CreditCard;
        $result = $multibanco->pagar($u->id, env('EUPAGO_API', ''), $refcompra, (float) $total, $numero, $cripto, $validade, $order["id"]);

        if($result["result"] == "correct"){
            $order_state = new OrderState();
            $order_state->order_id = $order["id"];
            $order_state->state_id = "1";
            $order_state->active = "1";
            $order_state->save();

            $values = array();
            $values["name"] = $u->name;
            $values["message"] = "Encomenda feita com sucesso, iremos verificar o seu pagamento.";

            $mail = new MailQueue();
            $mail->email = $u->email;
            $mail->subject = "Pagamento da Encomenda em ".setting('site.title');
            $mail->var = json_encode($values);
            $mail->view = "email.cc";
            $mail->status = "pending";
            $mail->save();

            return ["result" => "correct", "url" => $result["url"]];
        }else{
            return ["result" => "error"];
        }
    }

    /*public function success(Request $request){

        $identificador = $request->identificador;

        $compra = Transaco::where('transaction_id', '=', $identificador)->first();

        $order = Order::where("id", $compra->pedido_id)->first();

        $u = User::find($order->user_id);

        if($compra->estado == "pendente"){
            $compra->estado = "concluida";
            $compra->save();

            OrderState::where("order_id", $compra->pedido_id)->where("active", 1)->update(['active' => 0]);

            $order_state = new OrderState();
            $order_state->order_id = $compra->pedido_id;
            $order_state->state_id = "2";
            $order_state->active = "1";
            $order_state->save();

            $values = array();
            $values["name"] = $u->name;
            $values["message"] = "Recebemos o seu pagamento, vamos proceder com o envio da encomenda.";

            $mail = new MailQueue();
            $mail->email = $u->email;
            $mail->subject = "Pagamento da Encomenda em ".setting('site.title');
            $mail->var = json_encode($values);
            $mail->view = "email.cc";
            $mail->status = "pending";
            $mail->save();
        }
    }*/

    public function sent($id){
        $order = Order::where("id", $id)->first();

        $order->order_state = 3;
        $order->save();
        
        $u = User::find($order->user_id);

        $values = array();
        $values["name"] = $u->name;
        $values["message"] = "A sua Encomenda foi enviada, irá recebê-la em breve.";

        $mail = new MailQueue();
        $mail->email = $u->email;
        $mail->subject = "Encomenda em ".setting('site.title');
        $mail->var = json_encode($values);
        $mail->view = "email.cc";
        $mail->status = "pending";
        $mail->save();


        return redirect()
            ->route("voyager.orders.index")
            ->with([
                    'message'    => "Encomenda enviada com sucesso.",
                    'alert-type' => 'success',
                ]);
    }

    public function pay($id){
        $order = Order::where("id", $id)->first();
        
        $order->order_state = 2;
        $order->save();

        $u = User::find($order->user_id);

        $values = array();
        $values["name"] = $u->name;
        $values["message"] = "Pagamento Concluido";

        $mail = new MailQueue();
        $mail->email = $u->email;
        $mail->subject = "Pagamento da Encomenda em ".setting('site.title');
        $mail->var = json_encode($values);
        $mail->view = "email.cc";
        $mail->status = "pending";
        $mail->save();

        return redirect()
            ->route("voyager.orders.index")
            ->with([
                    'message'    => "Pagamento de encomenda efetuada com sucesso.",
                    'alert-type' => 'success',
                ]);
    }
}