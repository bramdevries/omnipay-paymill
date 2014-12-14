<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Response
 *
 * @author  Bram Devries <bram@madewithlove.be>
 * @package Omnipay\Paymill\Message
 */
class Response extends AbstractResponse
{
	const FAILED = 'failed';

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful()
	{
		$data = $this->getData();

		// Check if the request failed
		if (isset($data['error'])) {
			return false;
		}

		// The request succeeded, but the transaction could still fail
		return $data['status'] !== self::FAILED;
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
		$data    = $this->getData();
		$message = null;

		if (isset($data['error'])) {
			return $data['error'];
		}

		return ErrorMessage::getErrorForCode($data['response_code']);
	}

	/**
	 * @return mixed
	 */
	public function getData()
	{
		return isset($this->data['data']) ? $this->data['data'] : $this->data;
	}
}