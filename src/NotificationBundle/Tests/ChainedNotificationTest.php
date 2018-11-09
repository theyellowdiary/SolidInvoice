<?php

declare(strict_types=1);

/*
 * This file is part of SolidInvoice project.
 *
 * (c) 2013-2017 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\NotificationBundle\Tests;

use Mockery as M;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Namshi\Notificator\NotificationInterface;
use SolidInvoice\NotificationBundle\Notification\ChainedNotification;
use PHPUnit\Framework\TestCase;

class ChainedNotificationTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testAddNotifications()
    {
        $notification = new ChainedNotification();
        $message1 = M::mock(NotificationInterface::class);
        $message2 = M::mock(NotificationInterface::class);
        $message3 = M::mock(NotificationInterface::class);
        $notification->addNotification($message1);
        $notification->addNotification($message2);
        $notification->addNotification($message3);

        $this->assertSame([$message1, $message2, $message3], $notification->getNotifications());
    }

    public function testAddNotificationThroughConstructor()
    {
        $message1 = M::mock(NotificationInterface::class);
        $message2 = M::mock(NotificationInterface::class);
        $message3 = M::mock(NotificationInterface::class);
        $notification = new ChainedNotification([$message1, $message2, $message3]);

        $this->assertSame([$message1, $message2, $message3], $notification->getNotifications());
    }
}