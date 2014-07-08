<?php

namespace Blablacar\MemcachedBundle\Memcached;

use Blablacar\Memcached\Client;

class ClientLogger extends Client
{
    protected $client;

    protected $commands = array();

    /**
     * __construct
     *
     * @param Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * __call
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        $start = microtime(true);
        $return = $this->client->__call($name, $arguments);
        $duration = microtime(true) - $start;

        $this->commands[] = array(
            'name'      => $name,
            'arguments' => $this->flatten($arguments),
            'duration'  => $duration,
            'return'    => $this->flatten($return)
        );

        return $return;
    }

    /**
     * getCommands
     *
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * reset
     *
     * @return void
     */
    public function reset()
    {
        $this->commands = array();
    }

    /**
     * flatten
     *
     * @param mixed $arguments
     *
     * @return array
     */
    protected function flatten($arguments)
    {
        $list = [];

        if (null === $arguments) {
            return "null";
        }
        if (is_bool($arguments)) {
            return $arguments ? "true" : "false";
        }

        foreach ($arguments as $key => $item) {
            if (!is_numeric($key)) {
                $list[] = $key;
            }

            if (is_scalar($item)) {
                $list[] = strval($item);
            } elseif (null === $item) {
                $list[] = '<null>';
            } else {
                $this->flatten($item, $list);
            }
        }

        return $list;
    }
}
