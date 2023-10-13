# PHPUnit Commit Reminder

This is a simple extension that runs after a successful test run and reminds you to commit your changes.

This is useful if you are using a TDD approach, after fixing a failing test, you can be reminded to commit your changes.

The extension can also commit and push your changes for you with a prompt.

## Installation

Install the extension via composer.

```bash
composer require --dev vledermaus/phpunit-commit-reminder
```

## Configuration

Add the extension to your `phpunit.xml` file.

```xml
<extensions>
    <bootstrap class="Vledermaus\PHPUnitCommitReminder\Extension"></bootstrap>
</extensions>
```

## Usage

Run your tests as usual.

```bash
./vendor/bin/phpunit
```

When all tests pass, and there are changes in your working directory, you will be asked if you want to commit them.

```bash

......                                                              6 / 6 (100%)

Time: 00:00.007, Memory: 8.00 MB

OK (6 tests, 9 assertions)


🚨 You have uncommitted changes! 🚨


Do you want to commit them (this will add all changes)? [y/N]
> y

Please enter a commit message:
> My awesome commit message!

🎉  Changes committed! 🎉

Do you want to push them? [y/N]
> y

🚀  Changes pushed! 🚀
```
