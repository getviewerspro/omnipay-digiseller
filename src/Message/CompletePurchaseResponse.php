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

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data    = $data;

        if ($this->getSign() !== $this->calculateSignature()) {
            throw new InvalidResponseException('Invalid hash');
        }

        $this->customFields = base64_decode($this->data['through']);
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
        return $this->data['id_i'];
    }

    public function getTransactionReference()
    {
        return $this->customFields['payment_id'];
    }

    public function getPurse()
    {
        return $this->data['id_d'];
    }

    public function getAmount()
    {
        return (string)$this->data['amount'];
    }  

    public function getCurrency()
    {
        return (string)$this->data['curr'];
    }    
    
    public function getMoney()
    {
        return $this->getAmount().' '. $this->getCurrency();
    }
}
