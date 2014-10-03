<?php

namespace Omnipay\Paymill;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
	/**
	 * Get gateway display name
	 *
	 * This can be used by carts to get the display name for each gateway.
	 */
	public function getName()
	{
		return 'Paymill';
	}

	/**
	 * Get gateway default parameters
	 *
	 * @return array
	 */
	public function getDefaultParameters()
	{
		return array(
			'apiKey' => '',
		);
	}

	/**
	 * Get the gateway secret api key
	 *
	 * @return string
	 */
	public function getApiKey()
	{
		return $this->getParameter('apiKey');
	}

	/**
	 * Set the gateway secret api key
	 *
	 * @param $value
	 * @return $this
	 */
	public function setApiKey($value)
	{
		return $this->setParameter('apiKey', $value);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Paymill\Message\AuthorizeRequest
	 */
	public function authorize(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Paymill\Message\AuthorizeRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Paymill\Message\AuthorizeRequest
	 */
	public function capture(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Paymill\Message\CaptureRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Paymill\Message\PurchaseRequest
	 */
	public function purchase(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Paymill\Message\PurchaseRequest', $parameters);
	}

}