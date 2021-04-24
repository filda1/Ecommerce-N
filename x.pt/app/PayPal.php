<?php

namespace App;

use Omnipay\Omnipay;

/**
 * Class PayPal
 * @package App
 */
class PayPal
{
    /**
     * @return mixed
     */
    public function gateway()
    {
        $gateway = Omnipay::create('PayPal_Express');

        $gateway->setUsername(setting('site.paypal_username'));
        $gateway->setPassword(setting('site.paypal_password'));
        $gateway->setSignature(setting('site.paypal_signature'));
        $gateway->setTestMode(env('PAYPAL_SANDBOX'));

        return $gateway;
    }

    /**
     * @param array $parameters
     * @return mixed
     */
    public function purchase(array $parameters)
    {
        $response = $this->gateway()
            ->purchase($parameters)
            ->send();

        return $response;
    }

    /**
     * @param array $parameters
     */
    public function complete(array $parameters)
    {
        $response = $this->gateway()
            ->completePurchase($parameters)
            ->send();

        return $response;
    }

    /**
     * @param $amount
     */
    public function formatAmount($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    /**
     * @param $order
     */
    public function getCancelUrl()
    {
        return url('paypal/checkout-cancelled');
    }

    /**
     * @param $order
     */
    public function getReturnUrl($id)
    {
        return url('paypal/checkout-completed', $id);
    }

    /**
     * @param $order
     */
    public function getNotifyUrl($id)
    {
        $env = env('PAYPAL_SANDBOX') ? "sandbox" : "live";

        return url('webhook/paypal-ipn', [$id, $env]);
    }
}
