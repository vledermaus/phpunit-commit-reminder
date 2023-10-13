<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder;

final class Printer
{
    private mixed $input;
    private mixed $output;
    private mixed $error;

    public function __construct(
        mixed $input = STDIN,
        mixed $output = STDOUT,
        mixed $error = STDERR,
    ) {
        $this->input = $this->getStream($input);
        $this->output = $this->getStream($output);
        $this->error = $this->getStream($error);
    }

    public function print(string $message): void
    {
        fwrite($this->output, $message);
    }

    public function printLine(string $message = ''): void
    {
        fwrite($this->output, $message . PHP_EOL);
    }

    public function ask(string $question): string
    {
        $this->printLine($question);

        $answer = fgets($this->input);

        return trim($answer ?: '');
    }

    public function confirm(string $question): bool
    {
        $answer = $this->ask($question . ' [y/N]');

        return 'y' === strtolower($answer);
    }

    public function error(string $message): void
    {
        fwrite($this->error, $message . PHP_EOL);
    }

    private function getStream(mixed $stream): mixed
    {
        if (is_resource($stream)) {
            return $stream;
        }

        if (is_string($stream)) {
            return fopen($stream, 'wb+');
        }

        throw new \InvalidArgumentException('Invalid stream provided');
    }
}
