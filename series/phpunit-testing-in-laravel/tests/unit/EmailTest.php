<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 6/5/16
 */

namespace tests\unit;

use Mail;
use TestCase;
use tests\MailTracking;

class EmailTest extends TestCase
{
    use MailTracking;

    /** @test */
    public function sent_email()
    {
        Mail::raw('Hello World', function ($message) {
            $message->to('foo@bar.com');
            $message->from('bar@foo.com');
        });

        Mail::raw('Hello World', function ($message) {
            $message->to('foo@bar.com');
            $message->from('bar@foo.com');
        });

        $this->seeEmailWasSent();

        $this->seeEmailsSent(2);

        $this->seeEmailTo('foo@bar.com');
    }
}
