<?php
namespace NeosRulez\Neos\Scheduler\Domain\Repository;

/*
 * This file is part of the NeosRulez.Neos.Scheduler package.
 */

use DateTime;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Cron;

/**
 * @Flow\Scope("singleton")
 */
class TaskRepository extends Repository
{

    protected $defaultOrderings = array(
        'created' => \Neos\Flow\Persistence\QueryInterface::ORDER_DESCENDING,
    );

    /**
     * @Flow\Inject
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @Flow\Inject
     * @var \Neos\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;


    /**
     * @return array
     */
    public function findExecutable():array
    {
        $connection = $this->entityManager->getConnection();
        return $connection->executeQuery('SELECT * FROM neosrulez_neos_scheduler_domain_model_task WHERE startdatetime <= NOW() AND stopdatetime >= NOW() AND active = 1 OR startdatetime <= NOW() AND stopdatetime = null AND active = 1')->fetchAll();
    }

    /**
     * @param string $task
     * @return void
     */
    public function setExecution(string $task):void
    {
        $executedTask = $this->findByIdentifier($task);
        $executedTask->setLastExecution(new DateTime());
        if(!$executedTask->getRecurring()) {
            $executedTask->setActive(false);
        }
        $executedTask->setNextExecution($this->getNextRunDate($executedTask->getFrequency()));
        $this->update($executedTask);
        $this->persistenceManager->persistAll();
    }

    /**
     * @param string $frequency
     * @return DateTime
     */
    protected function getNextRunDate(string $frequency):DateTime
    {
        $cron = new Cron\CronExpression($frequency);
        return $cron->getNextRunDate();
    }



}
