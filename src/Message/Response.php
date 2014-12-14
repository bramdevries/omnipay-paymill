<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

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
		if (isset($this->getData()['id'])) {
			return $this->getData()['id'];
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

	/**
	 * @return mixed
	 */
	public function getData()
	{
		return isset($this->data['data']) ? $this->data['data'] : $this->data;
	}
}