<?php

namespace Blablacar\MemcachedBundle\Tests\Memcached;

use Blablacar\MemcachedBundle\Tests\TestCase;
use Blablacar\MemcachedBundle\Memcached\ClientLogger;

class ClientLoggerTest extends TestCase
{
    public function test_it_is_initilizable()
    {
        $client = $this->prophet->prophesize('Blablacar\Memcached\Client');

        $this->assertInstanceOf(
            'Blablacar\MemcachedBundle\Memcached\ClientLogger',
            new ClientLogger($client->reveal())
        );
    }
}
