<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder;

use CzProject\GitPhp\GitRepository;
use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Test\Errored;
use PHPUnit\Event\Test\Failed;

final class Application
{
    public const QUESTION_COMMIT_CHANGES = 'Do you want to commit them (this will add all changes)?';
    public const QUESTION_COMMIT_MESSAGE = "\nPlease enter a commit message:";
    public const QUESTION_PUSH_CHANGES = 'Do you want to push them?';
    public const MESSAGE_UNCOMMITTED_CHANGES = "\n\n🚨 You have uncommitted changes! 🚨\n\n";
    public const MESSAGE_CHANGES_COMMITTED = "\n🎉  Changes committed! 🎉\n";
    public const MESSAGE_CHANGES_PUSHED = "\n🚀  Changes pushed! 🚀\n";

    private bool $failed = false;

    public function __construct(
        private Printer $printer,
        private GitRepository $repository
    ) {
    }

    public function trace(Event $event): void
    {
        if (Failed::class === $event->className || Errored::class === $event->className) {
            $this->failed = true;
        }

        if (Finished::class === $event->className) {
            if ($this->failed || !$this->repository->hasChanges()) {
                return;
            }

            $this->finished();
        }
    }

    private function finished(): void
    {
        $this->printer->printLine(self::MESSAGE_UNCOMMITTED_CHANGES);
        if (!$this->printer->confirm(self::QUESTION_COMMIT_CHANGES)) {
            return;
        }

        $this->repository->addAllChanges();
        $commitMessage = $this->printer->ask(self::QUESTION_COMMIT_MESSAGE);
        $this->repository->commit($commitMessage);

        $this->printer->printLine(self::MESSAGE_CHANGES_COMMITTED);
        if (!$this->printer->confirm(self::QUESTION_PUSH_CHANGES)) {
            return;
        }

        $this->repository->push();
        $this->printer->printLine(self::MESSAGE_CHANGES_PUSHED);
    }
}
