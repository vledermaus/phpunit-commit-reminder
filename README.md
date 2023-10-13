# PHPUnit Commit Reminder

PHPUnit Commit Reminder is a convenient extension that streamlines your workflow by gently nudging you to commit your changes after a successful test run. It's particularly handy if you follow the Test-Driven Development (TDD) approach, ensuring that your codebase stays well-organized and up-to-date.

This extension can even handle the committing and pushing of your changes for you, saving you time and keeping your version control in sync.

## Installation

You can easily integrate PHPUnit Commit Reminder into your project by using Composer. Here's how to do it:

```bash
composer require --dev vledermaus/phpunit-commit-reminder
```

## Configuration

To activate the extension, add it to your phpunit.xml file as an extension. This configuration ensures that PHPUnit Commit Reminder runs automatically after your tests. Here's an example of how to do this:

```xml
<extensions>
    <bootstrap class="Vledermaus\PHPUnitCommitReminder\Extension"></bootstrap>
</extensions>
```

## Usage

Using PHPUnit Commit Reminder is straightforward. Simply run your PHPUnit tests as you usually do:

```bash
./vendor/bin/phpunit
```

Or, with laravel:

```bash
php artisan test
```

After the tests complete successfully, and there are uncommitted changes in your working directory, the extension will prompt you to commit them. This helps you maintain a clean and organized codebase. Here's an example of the prompt:

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

With PHPUnit Commit Reminder, you can stay focused on your code and let it handle the version control, making your workflow smoother and more efficient.

Give it a try and enjoy a more organized and streamlined development process!

## Contributing

Contributions are welcome! If you have suggestions, bug reports, or want to contribute to the project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes.
4. Submit a pull request.
