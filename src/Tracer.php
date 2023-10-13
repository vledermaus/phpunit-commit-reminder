<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder;

final class Tracer implements \PHPUnit\Event\Tracer\Tracer
{
    public function __construct(
        private Application $application
    ) {
    }

    public function trace(\PHPUnit\Event\Event $event): void
    {
        $this->application->trace(
            new Event(get_class($event))
        );
    }
}
