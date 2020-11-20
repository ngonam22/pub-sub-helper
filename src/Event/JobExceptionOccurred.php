<?php

namespace StQueue\Event;

class JobExceptionOccurred
{

    /**
     * The job instance.
     *
     * @var \ST\Replication\Queue\RabbitMQJob
     */
    public $job;

    /**
     * The exception instance.
     *
     * @var \Exception
     */
    public $exception;

    /**
     * Create a new event instance.
     *
     * @param  \ST\Replication\Queue\RabbitMQJob  $job
     * @param  \Exception  $exception
     * @return void
     */
    public function __construct($job, $exception)
    {
        $this->job = $job;
        $this->exception = $exception;
    }
}
