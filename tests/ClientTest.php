<?php

namespace Tests;

use BolCom\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = new Client(getenv('APP_KEY'), 'json', false);
    }

    /** @test */
    public function appKey()
    {
        $this->assertNotEquals(
            'YOUR_APP_KEY',
            getenv('APP_KEY'),
            "APP_KEY should be configured to run tests!\n\n" .
            "Run phpunit as follows:\n" .
            "APP_KEY=YOUR_APP_KEY phpunit\n" .
            "or fill in your APP_KEY in phpunit.xml\n"
        );
    }

    /** @test */
    public function getPingResponse()
    {
        $response = $this->client->getPingResponse();

        $this->assertObjectHasAttribute('message', $response);
        $this->assertEquals('Hello world!', $response->message);
    }

    /** @test */
    public function getProduct()
    {
        $response = $this->client->getProduct('9200000015051259');

        $this->assertObjectHasAttribute('products', $response);
        $this->assertInternalType('array', $response->products);
    }
}
