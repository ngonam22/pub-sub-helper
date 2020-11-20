<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019-12-23
 * Time: 11:32
 */

namespace PubSubHelper;

use PubSubHelper\Queue\RabbitMQConnector;

abstract class MainPublisher
{
    /**
     * Queue config
     * @var array
     */
    protected $config;

    /**
     * @var RabbitMQConnector
     */
    protected $connector;

    /**
     * Handle method will be called after the command is dispatched
     *
     * @return mixed
     */
    abstract public function handle();


    public function __construct(array $config)
    {
        $this->config = $config;
        $this->connector = new RabbitMQConnector($config);
    }

    /**
     * Dispatch the command
     *
     * @return MainPublisher
     */
    public static function dispatch()
    {
        // init the class and put in what it needs
        $self = new static(...func_get_args());
        $self->handle();

        return $self;
    }

    /**
     * @return RabbitMQConnector
     */
    public function getConnector(): RabbitMQConnector
    {
        return $this->connector;
    }

    /**
     * @param RabbitMQConnector $connector
     */
    public function setConnector(RabbitMQConnector $connector): void
    {
        $this->connector = $connector;
    }
}