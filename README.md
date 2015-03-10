# BlablacarMemcachedBundle

[![Build Status](https://travis-ci.org/blablacar/BlablacarMemcachedBundle.png)](https://travis-ci.org/blablacar/BlablacarMemcachedBundle)

A bundle to use memcached inside your Symfony2 application

## Installation

The recommended way to install this bundle is through
[Composer](http://getcomposer.org/).

    composer require blablacar/memcached-bundle

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

If you want to use the memcached session handler add the relevant config (see next section) and update your `app/config/config.yml` file:

```yml
framework:
    session:
        handler_id:  blablacar_memcached.session_handler
```

## Configuration reference

```yml
blablacar_memcached:
    clients:              # Required

        # Prototype
        name:
            persistent_id:        null
            servers:              [] # Required
            options:              []
    session:
        client:               ~ # Required
        prefix:               session
        ttl:                  ~
```

## License

Blablacar Memcached bundle is released under the MIT License. See the bundled
LICENSE file for details.
