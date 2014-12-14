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
        if (isset($this->data['data'])) {
            return in_array($this->data['data']['status'], array('closed', 'refunded'));
        }
		return !isset($this->data['error']);
	}

	/**
	 * Get the id of the resource
	 *
	 * @return mixed
	 */
	public function getTransactionReference()
	{
		if (isset($this->data['data']['id'])) {
			return $this->data['data']['id'];
		}
	}

	/**
	 * Get the error message
	 *
	 * @return null
	 */
    public function getMessage()
    {
        if (isset($this->data['error'])) {
            return $this->data['error'];
        }
        if (!$this->isSuccessful() && isset($this->data['data']['response_code'])) {
            return $this->data['data']['response_code'];
        }
    }

    /**
     * Gets the data from the request
     *
     * @return mixed
     */
    public function getData()
    {
        if (isset($this->data['data'])) return $this->data['data'];
        return $this->data;
    }
}
