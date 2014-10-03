<?php

namespace Omnipay\Paymill\Message;

/**
 * Class CaptureRequest
 *
 * @author Bram Devries <bram@madewithlove.be>
 * @package Omnipay\Paymill\Message
 */
class CaptureRequest extends AbstractRequest
{
	/**
	 * Get the data for this request
	 *
	 * @return array
	 */
	public function getData()
	{
		$this->validate('amount', 'description', 'currency', 'transactionReference');

		$data = array();

		$data['amount'] = $this->getAmountInteger();
		$data['currency'] = strtolower($this->getCurrency());
		$data['preauthorization'] = $this->getTransactionReference();
		$data['description'] = $this->getDescription();

		return $data;
	}

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