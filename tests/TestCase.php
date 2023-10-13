<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder\Tests;

use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Vledermaus\PHPUnitCommitReminder\Printer;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $input = null;
    protected $output = null;
    protected $error = null;
    protected ?Printer $printer = null;

    protected function setUp(): void
    {
        $this->input = fopen('php://memory', 'rwb');
        $this->output = fopen('php://memory', 'rwb');
        $this->error = fopen('php://memory', 'rwb');

        $this->printer = new Printer($this->input, $this->output, $this->error);
    }

    protected function getOutput(): string
    {
        rewind($this->output);

        return stream_get_contents($this->output);
    }

    protected function getError(): string
    {
        rewind($this->error);

        return stream_get_contents($this->error);
    }

    protected function setInput(array|string $message): void
    {
        if (is_array($message)) {
            $message = implode(PHP_EOL, $message);
        }

        fwrite($this->input, $message);
        rewind($this->input);
    }

    protected function mockGitRepository(bool $hasChanges = true): MockObject|GitRepository
    {
        /** @var MockObject|GitRepository $gitRepository */
        $gitRepository = $this->createMock(GitRepository::class);
        $gitRepository->method('hasChanges')->willReturn($hasChanges);

        return $gitRepository;
    }

    protected function mockGit(?GitRepository $gitRepository = null): MockObject|Git
    {
        /** @var MockObject|Git $git */
        $git = $this->createMock(Git::class);
        $git->method('open')->willReturn($gitRepository ?? $this->mockGitRepository());

        return $git;
    }
}
