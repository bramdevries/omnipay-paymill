<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Common\Message\ResponseInterface;

class AuthorizeRequest extends AbstractRequest
{

	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 */
	public function getData()
	{
		$this->validate('amount', 'currency', 'token');

		$data = array();

		$data['amount'] = $this->getAmountInteger();
		$data['currency'] = strtolower($this->getCurrency());
		$data['description'] = $this->getDescription();
		$data['capture'] = false;

		$data['token'] = $this->getToken();

		return $data;
	}


	/**
	 * Get the endpoint to Authorize
	 *
	 * @return string
	 */
	public function getEndpoint()
	{
		return $this->endpoint . '/preauthorizations';
	}

}