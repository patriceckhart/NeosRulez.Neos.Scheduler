<?php
namespace NeosRulez\Neos\Scheduler\Controller\Module;

/*
 * This file is part of the NeosRulez.Neos.Scheduler package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Fusion\View\FusionView;

class TaskController extends ActionController
{

    protected $defaultViewObjectName = FusionView::class;

    /**
     * @Flow\Inject
     * @var \NeosRulez\Neos\Scheduler\Domain\Repository\TaskRepository
     */
    protected $taskRepository;

    /**
     * @param string $argument
     * @param string $property
     * @return void
     */
    protected function convertDateTime(string $argument, string $property)
    {
        $this->arguments[$argument]->getPropertyMappingConfiguration()->forProperty($property)->setTypeConverterOption(\Neos\Flow\Property\TypeConverter\DateTimeConverter::class, \Neos\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d\TH:i');
    }

    /**
     * @return void
     */
    public function initializeCreateAction()
    {
        $this->convertDateTime('task', 'startDateTime');
        $this->convertDateTime('task', 'stopDateTime');
    }

    /**
     * @return void
     */
    public function initializeUpdateAction()
    {
        $this->convertDateTime('task', 'startDateTime');
        $this->convertDateTime('task', 'stopDateTime');
    }


    /**
     * @return void
     */
    public function indexAction():void
    {
        $tasks = $this->taskRepository->findAll();
        $this->view->assign('tasks', $tasks);
    }

    /**
     * @return void
     */
    public function newAction():void
    {
        $this->view->assign('flowPathRoot', constant('FLOW_PATH_ROOT'));
    }

    /**
     * @param \NeosRulez\Neos\Scheduler\Domain\Model\Task $task
     * @return void
     */
    public function createAction(\NeosRulez\Neos\Scheduler\Domain\Model\Task $task):void
    {
        $this->taskRepository->add($task);
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\Neos\Scheduler\Domain\Model\Task $task
     * @return void
     */
    public function editAction(\NeosRulez\Neos\Scheduler\Domain\Model\Task $task):void
    {
        $this->view->assign('command', rawurlencode($task->getCommand()));
        $this->view->assign('task', $task);
        $this->view->assign('flowPathRoot', constant('FLOW_PATH_ROOT'));
    }

    /**
     * @param \NeosRulez\Neos\Scheduler\Domain\Model\Task $task
     * @return void
     */
    public function updateAction(\NeosRulez\Neos\Scheduler\Domain\Model\Task $task):void
    {
        $this->taskRepository->update($task);
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\Neos\Scheduler\Domain\Model\Task $task
     * @return void
     */
    public function toggleAction(\NeosRulez\Neos\Scheduler\Domain\Model\Task $task):void
    {
        if($task->getActive()) {
            $task->setActive(false);
        } else {
            $task->setActive(true);
        }
        $this->taskRepository->update($task);
        $this->persistenceManager->persistAll();
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\Neos\Scheduler\Domain\Model\Task $task
     * @return void
     */
    public function removeAction(\NeosRulez\Neos\Scheduler\Domain\Model\Task $task):void
    {
        $this->taskRepository->remove($task);
        $this->persistenceManager->persistAll();
        $this->redirect('index');
    }


}