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
		return !isset($this->getData()['error']);
	}

}