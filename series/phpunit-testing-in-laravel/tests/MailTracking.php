<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 6/6/16
 */

namespace tests;

use Mail;
use Swift_Events_EventListener;
use Swift_Events_SendEvent;
use Swift_Message;
use TestCase;

trait MailTracking
{
    protected $emails = [];

    /** @before */
    public function setUpMailTracking()
    {
        Mail::getSwiftMailer()
            ->registerPlugin(new TestingMailEventListener($this));
    }

    public function seeEmailsSent($total)
    {
        $emailSent = count($this->emails);

        $this->assertCount($total, $this->emails, "Expected $total emails to have been sent, but $emailSent were.");
    }

    public function seeEmailWasSent()
    {
        $this->assertNotEmpty($this->emails, 'No emails have been sent.');
    }

    public function addEmail(Swift_Message $email)
    {
        $this->emails[] = $email;
    }
}

class TestingMailEventListener implements Swift_Events_EventListener
{
    /**
     * @var TestCase
     */
    protected $testClass;

    public function __construct(TestCase $testClass)
    {
        $this->testClass = $testClass;
    }

    public function beforeSendPerformed(Swift_Events_SendEvent $event)
    {
        $this->testClass->addEmail($event->getMessage());
    }
}
