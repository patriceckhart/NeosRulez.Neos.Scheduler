<?php
namespace NeosRulez\Neos\Scheduler\Domain\Model;

/*
 * This file is part of the NeosRulez.Neos.Scheduler package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Task
{

    /**
     * @var \DateTime
     */
    protected $startDateTime;

    /**
     * @return \DateTime
     */
    public function getStartDateTime() {
        return $this->startDateTime;
    }

    /**
     * @param \DateTime $startDateTime
     * @return void
     */
    public function setStartDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime;
    }

    /**
     * @var \DateTime
     * @ORM\Column(nullable=true)
     */
    protected $stopDateTime;

    /**
     * @return \DateTime
     */
    public function getStopDateTime() {
        return $this->stopDateTime;
    }

    /**
     * @param \DateTime $stopDateTime
     * @return void
     */
    public function setStopDateTime($stopDateTime)
    {
        $this->stopDateTime = $stopDateTime;
    }

    /**
     * @var \DateTime
     * @ORM\Column(nullable=true)
     */
    protected $lastExecution;

    /**
     * @return \DateTime
     */
    public function getLastExecution() {
        return $this->lastExecution;
    }

    /**
     * @param \DateTime $lastExecution
     * @return void
     */
    public function setLastExecution($lastExecution)
    {
        $this->lastExecution = $lastExecution;
    }

    /**
     * @var \DateTime
     * @ORM\Column(nullable=true)
     */
    protected $nextExecution;

    /**
     * @return \DateTime
     */
    public function getNextExecution() {
        return $this->nextExecution;
    }

    /**
     * @param \DateTime $nextExecution
     * @return void
     */
    public function setNextExecution($nextExecution)
    {
        $this->nextExecution = $nextExecution;
    }
    
    /**
     * @var string
     */
    protected $frequency;

    /**
     * @return string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param string $frequency
     * @return void
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * @var string
     * @ORM\Column(type="text")
     * @ORM\Column(length=9000)
     */
    protected $description;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @var string
     * @ORM\Column(type="text")
     * @ORM\Column(length=9000)
     */
    protected $command;

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param string $command
     * @return void
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    protected $email;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @var boolean
     */
    protected $recurring = true;

    /**
     * @return boolean
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param boolean $recurring
     * @return void
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;
    }

    /**
     * @var boolean
     */
    protected $active = true;

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return void
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @var \DateTime
     */
    protected $created;

    public function __construct() {
        $this->created = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

}
