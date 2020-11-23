<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 11/20/20
 * Time: 2:51 PM
 */

namespace PubSubHelper\Publisher;


use PubSubHelper\Helper\Arr;

class SimplePublisher extends AbstractPublisher
{


    /**
     * @var array = [
     *     'exchange_name' => (string), //required to specify the exchange name in config
     *     'properties' => [
     *          'x-signature' => (string)
     *     ],
     *     'routing_key' => (string),
     *     'priority' => (int),
     *     'expiration' => (int),
     *     'headers' => ([]),
     *     'properties' => ([]),
     *     'attempts' => (int),
     *     'delay' => (int), // in second
     * ]
     */
    protected $config = [];

    /**
     * Dispatch the message and return itself
     * Dev must close the connection manually
     *
     * @param array|int|bool $payload Message's payload data
     * @param array          $config  = $this->config
     * @return static
     * @throws \ReflectionException|\Exception
     * @throws \Interop\Queue\Exception
     */
    public static function dispatch($payload, array $config)
    {
        $self         = new static($config);
        $self->config = $config;

        // open the connection immediately
        // because of the type of this publisher: "Simple"
        $self->openConnection();

        // trigger the main function "handle"
        $self->handle($payload);

        return $self;
    }

    /**
     * Dispatch the message then destroy the connection to the Queue
     *
     * @param       $payload
     * @param array $config = $this->config
     * @throws \ReflectionException
     * @throws \Interop\Queue\Exception
     */
    public static function dispatchDestroy($payload, array $config)
    {
        self::dispatch($payload, $config)
            ->closeConnection()
        ;
    }

    /**
     * Publish the payload to the given config when init
     *
     * @param $payload
     * @throws \Interop\Queue\Exception|\Exception
     */
    public function handle($payload)
    {
        if (!Arr::exists('exchange_name', $this->config))
            throw new \Exception('Option value "exchange_name" is required');

        $exchangeCombination = $this->config['exchange_name'];
        unset($this->config['exchange_name']);

        $this->getConnector()->publish(
            $payload,
            $exchangeCombination,
            $this->config
        );
    }
}