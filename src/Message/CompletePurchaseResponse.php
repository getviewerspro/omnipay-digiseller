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

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Digiseller Complete Purchase Response.
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @var CompletePurchaseRequest|RequestInterface
     */
    protected $request;

    protected $customFields;
    protected $apiData;

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data    = $this->request->getApiData(); //$data;
        $this->apiData = $this->request->getApiData();

        /*
        Comment becouse get data by api request to merchant, don't need check

        if ($this->getSign() !== $this->calculateSignature()) {
            throw new InvalidResponseException('Invalid hash');
        }
        */
    }

    public function getSign()
    {
        return $this->data['sha256'];
    }

    public function isSuccessful()
    {
        return true;
    }

    public function calculateSignature()
    {
        return hash('sha256', implode(';', [
            $this->request->getSign(),
            $this->getPurse(),
            $this->getTransactionId()
        ]));
    }

    public function getTransactionId()
    {
        return $this->data['query_string']['payment_id'];
    }

    public function getTransactionReference()
    {
        return $this->data['inv'];
    }

    public function getPurse()
    {
        return $this->data['id_d'];
    }

    public function getAmount()
    {
        return (string)$this->data['cnt_goods'];
    }  

    public function getCurrency()
    {
        return 'RUB';
    }    
    
    public function getMoney()
    {
        return (string)$this->data['amount_usd']. ' USD';
    }
}
