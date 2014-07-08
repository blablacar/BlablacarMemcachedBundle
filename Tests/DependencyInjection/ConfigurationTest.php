<?php

namespace Blablacar\MemcachedBundle\Tests\DependencyInjection;

use Blablacar\MemcachedBundle\Tests\TestCase;
use Blablacar\MemcachedBundle\DependencyInjection\Configuration;

class ConfigurationTest extends TestCase
{
    public function test_it_is_initilizable()
    {
        $this->assertInstanceOf(
            'Blablacar\MemcachedBundle\DependencyInjection\Configuration',
            new Configuration()
        );
    }
}
