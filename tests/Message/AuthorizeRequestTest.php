<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
	public function setUp()
	{
		$this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
		$this->request->initialize(
			array(
				'amount' => '12.00',
				'currency' => 'USD',
				'card' => $this->getValidCard(),
				'description' => 'Order #42',
				'token' => 'credit_card_token',
			)
		);
	}

	public function testClientError()
	{
		$this->setMockHttpResponse('Unauthorized.txt');
		$this->request->setApiKey(null);

		$response = $this->request->send();
		$this->assertSame('Access Denied', $response->getMessage());
	}

	public function testGetData()
	{
		$data = $this->request->getData();

		$this->assertSame(1200, $data['amount']);
		$this->assertSame('usd', $data['currency']);
		$this->assertSame('Order #42', $data['description']);
		$this->assertSame('credit_card_token', $data['token']);
	}

	/**
	 * @expectedException \Omnipay\Common\Exception\InvalidRequestException
	 * @expectedExceptionMessage The token parameter is required
	 */
	public function testTokenRequired()
	{
		$this->request->setToken(null);
		$this->request->getData();
	}

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('AuthorizeSuccess.txt');
		$response = $this->request->send();

		$this->assertTrue($response->isSuccessful());
		$this->assertFalse($response->isRedirect());
		$this->assertSame('preauth_e396d56e773f745dfbd3', $response->getTransactionReference());
	}

	public function testSendError()
	{
		$this->setMockHttpResponse('AuthorizeFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
		$this->assertFalse($response->isRedirect());
		$this->assertNull($response->getTransactionReference());
		$this->assertSame('Token not Found', $response->getMessage());
	}
} 