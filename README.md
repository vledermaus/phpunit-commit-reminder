# PHPUnit Commit Reminder

This is a simple extension that runs after a successful test run and reminds you to commit your changes.

This is useful if you are using a TDD approach, after fixing a failing test, you can be reminded to commit your changes.

The script can also commit and push your changes for you with a prompt.

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
...

Time: 00:03.430, Memory: 78.50 MB

OK (192 tests, 517 assertions)


Changes detected on branch 'master'.

Do you want to commit your changes on branch 'master'? [y/N]
> yes

Enter commit message:
> My commit message

Changes committed successfully!

Don't forget to push your changes to remote!
```
