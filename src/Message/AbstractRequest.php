<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Class AbstractRequest
 *
 * @author Bram Devries <bram@madewithlove.be>
 * @package Omnipay\Paymill\Message
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
	/**
	 * @var string
	 */
	protected $endpoint = 'https://api.paymill.com/v2.1';

	/**
	 * @return mixed
	 */
	public function getApiKey()
	{
		return $this->getParameter('apiKey');
	}

	/**
	 * @param $value
	 * @return $this
	 */
	public function setApiKey($value)
	{
		return $this->setParameter('apiKey', $value);
	}

	/**
	 * Get the HTTP method to use for this request
	 *
	 * @return string
	 */
	public function getHttpMethod()
	{
		return 'POST';
	}

	/**
	 * Get the endpoint for this request
	 *
	 * @return mixed
	 */
	abstract public function getEndpoint();

	/**
	 * Send the request with specified data
	 *
	 * @param  mixed $data The data to send
	 * @return ResponseInterface
	 */
	public function sendData($data)
	{
		// don't throw exceptions for 4xx errors
		$this->httpClient->getEventDispatcher()->addListener(
			'request.error',
			function ($event) {
				if ($event['response']->isClientError()) {
					$event->stopPropagation();
				}
			}
		);

		$httpRequest = $this->httpClient->createRequest(
			$this->getHttpMethod(),
			$this->getEndpoint(),
			null,
			$data
		);

		$httpResponse = $httpRequest
			->setHeader('Authorization', 'Basic ' . base64_encode($this->getApiKey() . ':'))
			->send();

		return $this->response = new Response($this, $httpResponse->json());
	}
}