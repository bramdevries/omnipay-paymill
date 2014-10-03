<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
	public function setUp()
	{
		$this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest());
		$this->request->initialize(
			array(
				'amount' => '12.00',
				'currency' => 'USD',
				'description' => 'Order #42',
				'transactionReference' => 'trans_01',
			)
		);
	}

	public function testGetData()
	{
		$data = $this->request->getData();

		$this->assertSame(1200, $data['amount']);
		$this->assertSame('usd', $data['currency']);
		$this->assertSame('Order #42', $data['description']);
		$this->assertSame('trans_01', $data['preauthorization']);
	}

	/**
	 * @expectedException \Omnipay\Common\Exception\InvalidRequestException
	 * @expectedExceptionMessage The amount parameter is required
	 */
	public function testAmountRequired()
	{
		$this->request->setAmount(null);
		$this->request->getData();
	}

	public function testSendSuccess()
	{
		$this->setMockHttpResponse('CaptureSuccess.txt');
		$response = $this->request->send();

		$this->assertTrue($response->isSuccessful());
		$this->assertFalse($response->isRedirect());
		$this->assertSame('tran_1f42e10cf14301067332', $response->getTransactionReference());
	}

	public function testSendError()
	{
		$this->setMockHttpResponse('CaptureFailure.txt');
		$response = $this->request->send();

		$this->assertFalse($response->isSuccessful());
		$this->assertFalse($response->isRedirect());
		$this->assertNull($response->getTransactionReference());
		$this->assertSame('Preauthorization has already been used', $response->getMessage());
	}
} 