<?php
/**
 * digiseller driver for Omnipay PHP payment library
 *
 * @link      https://github.com/getviewerspro/omnipay-digiseller
 * @package   omnipay-digiseller
 * @license   MIT
 * @copyright Copyright (c) 2023, getViewersPRO (https://getviewers.pro/)
 */

namespace Omnipay\Digiseller;

use Omnipay\Common\AbstractGateway;

/**
 * Gateway for ePayService.
 */
class Gateway extends AbstractGateway
{
    /**
     *
     */
    public function getName()
    {
        return 'Digiseller';
    }

    /**
     *
     */
    public function getDefaultParameters()
    {
        return [
            'purse' => '',
        ];
    }

    /**
     * Get the unified purse.
     * @return string merchant purse
     */
    public function getPurse()
    {
        return $this->getParameter('purse');
    }

    /**
     * Set the unified purse.
     * @param string $purse merchant purse
     * @return self
     */
    public function setPurse($value)
    {
        return $this->setParameter('purse', $value);
    }

    /**
     * Get the unified secret key.
     * @return string secret key
     */
    public function getApiDAta($value)
    {
        return $this->setParameter('api_data', $value);
    }

    /**
     * Get the unified secret key.
     * @return string secret key
     */
    public function getSign()
    {
        return $this->getParameter('sign');
    }

    /**
     * Set the unified secret key.
     * @param string $value secret key
     * @return self
     */
    public function setSign($value)
    {
        return $this->setParameter('sign', $value);
    }


    /**
     * @param array $parameters
     * @return \Omnipay\ePayService\Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Digiseller\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\ePayService\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Digiseller\Message\CompletePurchaseRequest', $parameters);
    }
}
