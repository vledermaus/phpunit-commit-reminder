<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder\Tests;

use CzProject\GitPhp\Git;
use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\TestRunner\BootstrapFinished;
use Vledermaus\PHPUnitCommitReminder\Application;
use Vledermaus\PHPUnitCommitReminder\Event;

final class ApplicationTest extends TestCase
{
    public function test_application_should_do_nothing_when_finished_event_is_not_triggered(): void
    {
        $application = new Application($this->printer, $this->mockGitRepository());

        $application->trace(new Event(BootstrapFinished::class));

        $actual = $this->getOutput();

        $this->assertEmpty($actual);
    }

    public function test_application_should_do_nothing_when_1_or_more_tests_fail(): void
    {
        $git = new Git();
        $application = new Application($this->printer, $this->mockGitRepository());

        $application->trace(new Event(Failed::class));
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertEmpty($actual);
    }

    public function test_application_should_do_nothing_when_git_has_no_changes(): void
    {
        $application = new Application($this->printer, $this->mockGitRepository(false));

        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertEmpty($actual);
    }

    public function test_application_should_do_nothing_when_user_does_not_want_to_commit_changes(): void
    {
        $application = new Application($this->printer, $this->mockGitRepository());

        $this->setInput('n');
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertStringContainsString(Application::MESSAGE_UNCOMMITTED_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_CHANGES, $actual);
    }

    public function test_application_should_add_all_changes_when_user_confirms(): void
    {
        $gitRepository = $this->mockGitRepository();
        $gitRepository->expects($this->once())->method('addAllChanges');

        $application = new Application($this->printer, $gitRepository);

        $this->setInput('y');
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertStringContainsString(Application::MESSAGE_UNCOMMITTED_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_CHANGES, $actual);
    }

    public function test_application_should_do_nothing_when_user_does_not_confirm_to_commit(): void
    {
        $gitRepository = $this->mockGitRepository();
        $gitRepository->expects($this->never())->method('addAllChanges');

        $application = new Application($this->printer, $gitRepository);

        $this->setInput('n');
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertStringContainsString(Application::MESSAGE_UNCOMMITTED_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_CHANGES, $actual);
    }

    public function test_application_should_ask_for_a_commit_message(): void
    {
        $gitRepository = $this->mockGitRepository();
        $gitRepository->expects($this->once())->method('addAllChanges');

        $application = new Application($this->printer, $gitRepository);

        $this->setInput('y');
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertStringContainsString(Application::MESSAGE_UNCOMMITTED_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_MESSAGE, $actual);
    }

    public function test_application_should_commit_with_user_given_message(): void
    {
        $commitMessage = 'My awesome commit!';

        $gitRepository = $this->mockGitRepository();
        $gitRepository->expects($this->once())->method('addAllChanges');
        $gitRepository->expects($this->once())->method('commit')->with($commitMessage);

        $application = new Application($this->printer, $gitRepository);

        $this->setInput(['y', $commitMessage]);
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertStringContainsString(Application::MESSAGE_UNCOMMITTED_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_MESSAGE, $actual);

        $this->assertStringContainsString(Application::MESSAGE_CHANGES_COMMITTED, $actual);
    }

    public function test_application_should_not_push_when_user_does_not_confirm(): void
    {
        $commitMessage = 'My awesome commit!';

        $gitRepository = $this->mockGitRepository();
        $gitRepository->expects($this->once())->method('addAllChanges');
        $gitRepository->expects($this->once())->method('commit')->with($commitMessage);
        $gitRepository->expects($this->never())->method('push');

        $application = new Application($this->printer, $gitRepository);

        $this->setInput(['y', $commitMessage, 'n']);
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertStringContainsString(Application::MESSAGE_UNCOMMITTED_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_MESSAGE, $actual);

        $this->assertStringContainsString(Application::MESSAGE_CHANGES_COMMITTED, $actual);
        $this->assertStringContainsString(Application::QUESTION_PUSH_CHANGES, $actual);

        $this->assertStringNotContainsString(Application::MESSAGE_CHANGES_PUSHED, $actual);
    }

    public function test_application_should_push_when_user_confirms(): void
    {
        $commitMessage = 'My awesome commit!';

        $gitRepository = $this->mockGitRepository();
        $gitRepository->method('hasChanges')->willReturn(true);
        $gitRepository->expects($this->once())->method('addAllChanges');
        $gitRepository->expects($this->once())->method('commit')->with($commitMessage);
        $gitRepository->expects($this->once())->method('push');

        $application = new Application($this->printer, $gitRepository);

        $this->setInput(['y', $commitMessage, 'y']);
        $application->trace(new Event(Finished::class));

        $actual = $this->getOutput();

        $this->assertStringContainsString(Application::MESSAGE_UNCOMMITTED_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_CHANGES, $actual);
        $this->assertStringContainsString(Application::QUESTION_COMMIT_MESSAGE, $actual);

        $this->assertStringContainsString(Application::MESSAGE_CHANGES_COMMITTED, $actual);
        $this->assertStringContainsString(Application::QUESTION_PUSH_CHANGES, $actual);

        $this->assertStringContainsString(Application::MESSAGE_CHANGES_PUSHED, $actual);
    }
}
