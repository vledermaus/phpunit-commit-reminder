<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder;

final class Event
{
    public function __construct(
        public readonly string $className,
    ) {
        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Invalid class name provided');
        }

        if (!is_subclass_of($className, \PHPUnit\Event\Event::class)) {
            throw new \InvalidArgumentException('Invalid event class name provided');
        }
    }
}
