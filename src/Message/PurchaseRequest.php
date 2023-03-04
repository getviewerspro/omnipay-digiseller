<?php
/**
 * Digiseller driver for Omnipay PHP payment library
 *
 * @link      https://github.com/getviewerspro/omnipay-digiseller
 * @package   omnipay-digiseller
 * @license   MIT
 * @copyright Copyright (c) 2023, getViewersPRO (https://getviewers.pro/)
 */

namespace Omnipay\Digiseller\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate(
            'purse',
            'amount'
        );

        return array_filter([
            'id_d'          => $this->getPurse(),
            'payment_id'    => $this->getTransactionId(),
            'a'             => $this->getAmount(),
            's'             => $this->calculateSignature(),
            'd'             => $this->getDescription(),
            'p'             => $this->getPaymentMethod(),
            'cr'            => $this->getCurrency(),
            'lang'          => $this->getLocale()
        ]);
    }

    public function calculateSignature()
    {
        return hash('sha256', implode(';', [
            $this->request->getSign(),
            $this->getPurse(),
            $this->getTransactionId()
        ]));
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
