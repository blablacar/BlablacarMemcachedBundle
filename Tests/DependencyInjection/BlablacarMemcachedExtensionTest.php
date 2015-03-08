<?php

namespace Blablacar\MemcachedBundle\Tests\DependencyInjection;

use Blablacar\MemcachedBundle\DependencyInjection\BlablacarMemcachedExtension;

class BlablacarMemcachedExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_initilizable()
    {
        $this->assertInstanceOf(
            'Blablacar\MemcachedBundle\DependencyInjection\BlablacarMemcachedExtension',
            new BlablacarMemcachedExtension()
        );
    }
}
