<?php

namespace Omnipay\Paymill\Message;

use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{
	public function setUp()
	{
		$this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
		$this->request->initialize(
			array(
				'amount' => '12.00',
				'description' => 'Refund this!',
				'transactionReference' => 'trans_02',
			)
		);
	}

	public function testGetData()
	{
		$data = $this->request->getData();

		$this->assertSame(1200, $data['amount']);
		$this->assertSame('Refund this!', $data['description']);
		$this->assertSame('trans_02', $this->request->getTransactionReference());
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
		$this->setMockHttpResponse('RefundSuccess.txt');
		$response = $this->request->send();

		$this->assertTrue($response->isSuccessful());
		$this->assertFalse($response->isRedirect());
		$this->assertSame('refund_70392dc6a734a8233130', $response->getTransactionReference());
	}
} 