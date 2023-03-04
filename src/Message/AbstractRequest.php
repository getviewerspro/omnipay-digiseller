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

use League\Omnipay\Common\Locale;

/**
 * Digiseller Abstract Request.
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $zeroAmountAllowed = false;

    /**
     * Get the purse.
     * @return string purse
     */
    public function getPurse()
    {
        return $this->getParameter('id_d');
    }

    /**
     * Set the purse.
     * @param string $purse purse
     * @return self
     */
    public function setPurse($value)
    {
        return $this->setParameter('purse', $value);
    }

    /**
     * Get the secret key.
     * @return string secret key
     */
    public function getSign()
    {
        return $this->getParameter('sha256');
    }

    /**
     * Set the secret key.
     * @param string $key secret key
     * @return self
     */
    public function setSign($value)
    {
        return $this->setParameter('sha256', $value);
    }

        /**
     * Get the request locale.
     *
     * @return Locale
     */
    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    /**
     * Set the request Locale
     *
     * @param  string|Locale $value
     * @throws InvalidRequestException
     * @return AbstractRequest Provides a fluent interface
     */
    public function setLocale($value)
    {
        if (is_string($value)) {
            $value = Locale::parse($value);
        }

        if (! $value instanceof Locale) {
            throw new InvalidRequestException('A valid Locale is required');
        }

        return $this->setParameter('locale', $value);
    }
}
