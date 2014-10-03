<?php

namespace Omnipay\Paymill;


use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
	public function setUp()
	{
		parent::setUp();

		$this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
	}

	public function testAuthorize()
	{
		$request = $this->gateway->authorize(array('amount' => '10.00'));

		$this->assertInstanceOf('Omnipay\Paymill\Message\AuthorizeRequest', $request);
		$this->assertSame('10.00', $request->getAmount());
	}

	public function testCapture()
	{
		$request = $this->gateway->capture(array('amount' => '10.00'));

		$this->assertInstanceOf('Omnipay\Paymill\Message\CaptureRequest', $request);
		$this->assertSame('10.00', $request->getAmount());
	}

	public function testPurchase()
	{
		$request = $this->gateway->purchase(array('amount' => '10.00'));

		$this->assertInstanceOf('Omnipay\Paymill\Message\PurchaseRequest', $request);
		$this->assertSame('10.00', $request->getAmount());
	}
} 