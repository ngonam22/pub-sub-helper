<?php
/**
 * Created by PhpStorm.
 * User: Nam Ngo
 * Date: 2019-11-06
 * Time: 14:18
 */

namespace StQueue\CommonTrait;

use \Zend\EventManager\EventManagerInterface;
use Zend\EventManager\SharedEventManager;

trait EventManagerTrait
{
    /**
     * @var \Zend\EventManager\EventManagerInterface;
     */
    protected $eventManager;

    protected $sharedEventManager;

    public function setEventManager(EventManagerInterface $event)
    {
        $this->eventManager = $event;
    }

    public function getEventManager()
    {
        return $this->eventManager;
    }

    public function getSharedEventManager()
    {
        if (empty($this->sharedEventManager)) {
            $this->sharedEventManager = new SharedEventManager();
        }

        return $this->sharedEventManager;
    }
}