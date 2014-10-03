<?php

namespace Omnipay\Paymill\Message;

/**
 * Class PurchaseRequest
 *
 * @author Bram Devries <bram@madewithlove.be>
 * @package Omnipay\Paymill\Message
 */
class PurchaseRequest extends AuthorizeRequest
{
	/**
	 * The endpoint for this request
	 *
	 * @return string
	 */
	public function getEndpoint()
	{
		return $this->endpoint . '/transactions';
	}
} 