<?php

namespace App;
use SoapClient;
use Session;
use Log;
/**
 * Class PayPal
 * @package App
 */
class CreditCard
{

    protected $urlAPIEupago="https://sandbox.eupago.pt/clientes/rest_api";
    //protected $urlAPIEupago="https://clientes.eupago.pt/clientes/rest_api";

    public function pagar($user_id, $chave_api, $nota_de_encomenda, $valor_da_encomenda, $cc, $ccv, $validade, $pedido_id = null)
    {

        $compra = new Transaco();
        $compra->user_id = $user_id;
        $compra->ip_address = \Request::ip();
        $compra->transaction_id = $nota_de_encomenda;
        $compra->valor = $valor_da_encomenda;
        $compra->cc_id = "0";
        $compra->estado = "pendente";
        $compra->pedido_id = $pedido_id;
        $compra->save();
        
    	$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->urlAPIEupago."/cc/purchase_tds");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            "chave=" . $chave_api . "&valor=" . $valor_da_encomenda . "&id=" . $nota_de_encomenda . "&numero=" . $cc . "&cripto=" . $ccv . "&validade=" . $validade . "&url_retorno=" . "https://casadelaraias.pt/eupago-status?");


		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);

		curl_close ($ch);

        $result = json_decode($result, true);
		if ($result["sucesso"]) {
            return ["result" => "correct", "url" => $result["tds_url"]];
        } else {
            return ["result" => "error"];
        }

    }
}
