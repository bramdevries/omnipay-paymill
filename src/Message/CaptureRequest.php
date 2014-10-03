<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Paymill\Message\AbstractRequest;

class CaptureRequest extends AbstractRequest
{
	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
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

	public function getEndpoint()
	{
		return $this->endpoint . '/transactions';
	}

} 