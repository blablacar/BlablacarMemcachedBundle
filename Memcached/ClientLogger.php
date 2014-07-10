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
            'return'    => $this->clean($return)
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
     * @param array $list
     *
     * @return array
     */
    protected function flatten($arguments, array &$list = array())
    {
        $list = array();
        foreach ((array) $arguments as $key => $item) {
            if (!is_numeric($key)) {
                $list[] = $key;
            }

            $list = $this->clean($item);
        }

        return $list;
    }

    /**
     * clean
     *
     * @param mixed $argument
     *
     * @return string
     */
    protected function clean($argument)
    {
        if (is_bool($argument)) {
            return $argument ? 'true' : 'false';
        }
        if (is_scalar($argument)) {
            return strval($argument);
        }
        if (null === $argument) {
            return '<null>';
        }
        if (is_object($argument)) {
            return get_class($argument);
        }
        if (is_array($argument)) {
            return '<array>';
        }

        return '<unknown>';
    }
}
