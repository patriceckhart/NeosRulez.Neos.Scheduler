<?php
namespace NeosRulez\Neos\Scheduler\Domain\Service;

/*
 * This file is part of the NeosRulez.Neos.Scheduler package.
 */

use Neos\Flow\Annotations as Flow;

class MailService
{

    /**
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings) {
        $this->settings = $settings;
    }

    /**
     * @param array $task
     * @return void
     */
    public function sendMail(array $task):void
    {
        $view = new \Neos\FluidAdaptor\View\StandaloneView();
        $view->setTemplatePathAndFilename($this->settings['templatePathAndFilename']);
        $view->assignMultiple($task);

        $mail = new \Neos\SwiftMailer\Message();
        $mail
            ->setFrom([$this->settings['senderMail'] => $this->settings['senderMail']])
            ->setTo([$task['email'] => $task['email']])
            ->setSubject('NeosRulez.Neos.Scheduler');

        $mail->setBody($view->render(), 'text/html');
        $mail->send();

    }

}