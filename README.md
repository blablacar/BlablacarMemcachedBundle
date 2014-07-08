# BlablacarMemcachedBundle

[![Build Status](https://travis-ci.org/blablacar/BlablacarMemcachedBundle.png)](https://travis-ci.org/blablacar/BlablacarMemcachedBundle)

A bundle to use memcached inside your Symfony2 application

## Installation

The recommended way to install this bundle is through
[Composer](http://getcomposer.org/). Require the `blablacar/memcached-bundle`
package into your `composer.json` file:

```json
{
    "require": {
        "blablacar/memcached-bundle": "@stable"
    }
}
```

**Protip:** you should browse the
[`blablacar/memcached-bundle`](https://packagist.org/packages/blablacar/memcached-bundle)
page to choose a stable version to use, avoid the `@stable` meta constraint.

Update `app/AppKernel.php`:

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Blablacar\MemcachedBundle\BlablacarMemcachedBundle(),
    );

    return $bundles;
}
```

## Configuration reference

```yml
blablacar_memcached:
    clients:
        my_client_name:
            persistent_id: ~
            servers:       ['127.0.0.1:11211']
```

## License

Blablacar Memcached bundle is released under the MIT License. See the bundled
LICENSE file for details.
