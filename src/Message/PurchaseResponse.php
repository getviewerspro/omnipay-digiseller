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

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Digiseller Purchase Response.
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $_redirect = 'https://www.digiseller.market/asp2/pay_wm.asp';

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $redirect = $this->_redirect;

        return $redirect . '?' . http_build_query($this->getRedirectData());
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}
