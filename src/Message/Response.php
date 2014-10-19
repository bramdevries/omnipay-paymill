<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class Response
 *
 * @author Bram Devries <bram@madewithlove.be>
 * @package Omnipay\Paymill\Message
 */
class Response extends AbstractResponse
{
	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful()
	{
		return !isset($this->data['error']);
	}

	/**
	 * Get the id of the resource
	 *
	 * @return mixed
	 */
	public function getTransactionReference()
	{
		if (isset($this->data['id'])) {
			return $this->data['id'];
		}
	}

	/**
	 * Get the error message
	 *
	 * @return null
	 */
	public function getMessage()
	{
		return !$this->isSuccessful() ? $this->data['error'] : null;
	}
}