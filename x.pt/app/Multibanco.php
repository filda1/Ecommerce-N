<?php

namespace App;
use SoapClient;
use Session;
use Log;
/**
 * Class PayPal
 * @package App
 */
class Multibanco
{
    protected $urlAPIEupago="https://sandbox.eupago.pt/clientes/rest_api";
    //protected $urlAPIEupago="https://clientes.eupago.pt/clientes/rest_api";

    public function gerarReferencia($user_id, $chave_api, $nota_de_encomenda, $valor_da_encomenda, $date, $pedido_id = null)
    {

        $compra = new Transaco();
        $compra->user_id = $user_id;
        $compra->ip_address = \Request::ip();
        $compra->estado = "pendente";
        $compra->transaction_id = $nota_de_encomenda;
        $compra->valor = $valor_da_encomenda;
        $compra->pedido_id = $pedido_id;
        $compra->save();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->urlAPIEupago."/multibanco/create");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "chave=" . $chave_api . "&valor=" . $valor_da_encomenda . "&id=" . $nota_de_encomenda . "&data_fim=" . $date);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close ($ch);

        $result = json_decode($result, true);
        if ($result["sucesso"]) { //estados possíveis: 0 sucesso. -10 Chave inválida. -9 Valores incorretos 
            $compra->multibanco_entidade = $result["entidade"];
            $compra->multibanco_referencia = $result["referencia"];
            $compra->save();
            return [ "result" => "correct", "entidade" => $result["entidade"], "referencia" => $result["referencia"], "valor" => $valor_da_encomenda];
        } else {
            return ["result" => "error"];
        }
    }
}
