<?php

namespace Blablacar\MemcachedBundle\Tests\Memcached;

use Blablacar\MemcachedBundle\Memcached\ClientLogger;

class ClientLoggerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_initilizable()
    {
        $client = $this->prophesize('Blablacar\Memcached\Client');

        $this->assertInstanceOf(
            'Blablacar\MemcachedBundle\Memcached\ClientLogger',
            new ClientLogger($client->reveal())
        );
    }
}
