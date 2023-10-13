<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder\Tests;

use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Test\Failed;
use PHPUnit\Framework\TestCase;
use Vledermaus\PHPUnitCommitReminder\Event;

final class EventTest extends TestCase
{
    public function test_construct_with_invalid_class_name_should_throw_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Event('not-a-real-class');
    }

    public function test_construct_with_invalid_event_class_name_should_throw_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Event(TestCase::class);
    }

    public function test_construct_with_valid_event_class_name_should_not_throw_exception()
    {
        $this->expectNotToPerformAssertions();

        new Event(Failed::class);
    }

    public function test_constructor_gets_class_name()
    {
        $className = Finished::class;
        $event = new Event($className);

        $this->assertEquals($className, $event->className);
    }
}
