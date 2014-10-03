<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
	public function setUp()
	{
		$this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
		$this->request->initialize(
			array(
				'amount' => '12.00',
				'currency' => 'USD',
				'description' => 'Order #42',
				'token' => 'card_token',
			)
		);
	}

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('CaptureSuccess.txt');
		$response = $this->request->send();

		$this->assertTrue($response->isSuccessful());
		$this->assertFalse($response->isRedirect());
		$this->assertSame('tran_1f42e10cf14301067332', $response->getTransactionReference());
	}
} 