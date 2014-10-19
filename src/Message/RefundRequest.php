<?php

namespace Omnipay\Paymill\Message;

/**
 * Class RefundRequest
 *
 * @author Bram Devries <bram@madewithlove.be>
 * @package Omnipay\Paymill\Message
 */
class RefundRequest extends AbstractRequest
{
	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 */
	public function getData()
	{
		$this->validate('transactionReference', 'amount');

		$data = array();
		$data['amount'] = $this->getAmountInteger();
		$data['description'] = $this->getDescription();

		return $data;
	}

	/**
	 * Get the endpoint for this request
	 *
	 * @return mixed
	 */
	public function getEndpoint()
	{
		return $this->endpoint . '/refunds/' . $this->getTransactionReference();
	}

} 