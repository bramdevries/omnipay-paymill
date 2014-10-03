<?php

namespace Omnipay\Paymill\Message;


use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful()
	{
		return !isset($this->getData()['error']);
	}

}