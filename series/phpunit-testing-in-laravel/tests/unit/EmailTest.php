<?php
/**
 * @author Rizart Dokollari <***REMOVED***>
 * @since 6/5/16
 */

namespace tests\unit;

use Mail;
use Swift_Events_EventListener;
use Swift_Events_SendEvent;

class EmailTest extends \TestCase
{
    public function setUp()
    {
        parent::setUp();

        Mail::getSwiftMailer()
            ->registerPlugin(new TestingMailEventListener);
    }

    /** @test */
    public function sent_email()
    {
        Mail::raw('Hello World', function ($message) {
            $message->to('foo@bar.com');
            $message->from('bar@foo.com');
        });

        $this->seeEmailWasSent();
    }

    public function seeEmailWasSent()
    {
    }
}

class TestingMailEventListener implements Swift_Events_EventListener
{
    public function beforeSendPerformed(Swift_Events_SendEvent $event)
    {
        $message = $event->getMessage();

        dd($message->getFrom());
    }
}