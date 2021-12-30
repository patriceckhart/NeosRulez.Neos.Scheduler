<?php
namespace NeosRulez\Neos\Scheduler\Command;

/*
 * This file is part of the NeosRulez.Neos.Scheduler package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

/**
 * @Flow\Scope("singleton")
 */
class SchedulerCommandController extends CommandController
{

    /**
     * @Flow\Inject
     * @var \NeosRulez\Neos\Scheduler\Domain\Service\TaskService
     */
    protected $taskService;

    /**
     * @return void
     * @throws \Exception
     */
    public function executeCommand()
    {
        $tasks = $this->taskService->executeTasks();
        $this->outputLine("\n" . $tasks);
    }

}