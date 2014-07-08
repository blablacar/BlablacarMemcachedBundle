<?php

namespace Blablacar\MemcachedBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blablacar\MemcachedBundle\Memcached\ClientLogger;

class MemcachedDataCollector extends DataCollector
{
    protected $clients = array();

    public function addClient($name, ClientLogger $client)
    {
        $this->clients[$name] = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        foreach ($this->clients as $name => $client) {
            foreach ($client->getCommands() as $command) {
                $this->data[] = array(
                    'command'    => $command['name'],
                    'arguments'  => implode(', ', $command['arguments']),
                    'duration'   => $command['duration'],
                    'connection' => $name,
                    'return'     => implode(', ', $command['return'])
                );
            }

            $client->reset();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'memcached';
    }

    /**
     * getCommands
     *
     * @return array
     */
    public function getCommands()
    {
        return $this->data;
    }

    /**
     * getDuration
     *
     * @return int
     */
    public function getDuration()
    {
        $time = 0;
        foreach ($this->data as $data) {
            $time += $data['duration'];
        }

        return $time;
    }
}
