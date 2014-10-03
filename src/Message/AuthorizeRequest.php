<?php

namespace Omnipay\Paymill\Message;

/**
 * Class AuthorizeRequest
 *
 * @author Bram Devries <bram@madewithlove.be>
 * @package Omnipay\Paymill\Message
 */
class AuthorizeRequest extends AbstractRequest
{

	/**
	 * Get the data for this request
	 *
	 * @return array
	 */
	public function getData()
	{
		$this->validate('amount', 'currency', 'token');

		$data = array();

		$data['amount'] = $this->getAmountInteger();
		$data['currency'] = strtolower($this->getCurrency());
		$data['description'] = $this->getDescription();

		$data['token'] = $this->getToken();

		return $data;
	}


	/**
	 * The endpoint for this request
	 *
	 * @return string
	 */
	public function getEndpoint()
	{
		return $this->endpoint . '/preauthorizations';
	}

}