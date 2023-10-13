<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder\Tests;

final class PrinterTest extends TestCase
{
    public function test_method_print(): void
    {
        $this->printer->print('Hello, world!');
        $actual = $this->getOutput();

        $this->assertEquals('Hello, world!', $actual);
    }

    public function test_method_print_line(): void
    {
        $this->printer->printLine('Hello, world!');

        $actual = $this->getOutput();

        $this->assertEquals("Hello, world!\n", $actual);
    }

    public function test_method_ask(): void
    {
        $this->setInput('A very long message... Not!');

        $actual = $this->printer->ask('Write your message here:');

        $this->assertEquals('A very long message... Not!', $actual);
        $this->assertStringContainsString('Write your message here:', $this->getOutput());
    }

    public function test_method_confirm_with_yes(): void
    {
        $this->setInput('y');

        $actual = $this->printer->confirm('Are you sure?');

        $this->assertTrue($actual);
        $this->assertStringContainsString('Are you sure? [y/N]', $this->getOutput());
    }

    public function test_method_confirm_with_no(): void
    {
        $this->setInput('n');

        $actual = $this->printer->confirm('Are you sure?');

        $this->assertFalse($actual);
        $this->assertStringContainsString('Are you sure? [y/N]', $this->getOutput());
    }

    public function test_method_error(): void
    {
        $this->printer->error('An error occurred!');

        $actual = $this->getError();

        $this->assertEquals("An error occurred!\n", $actual);
    }
}
