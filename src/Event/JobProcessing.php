<?php

namespace StQueue\Event;

class JobProcessing
{
    /**
     * The job instance.
     *
     * @var \ST\Replication\Queue\RabbitMQJob
     */
    public $job;

    /**
     * Create a new event instance.
     *
     * @param  \ST\Replication\Queue\RabbitMQJob  $job
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
    }
}
