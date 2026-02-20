# Contributing to JazzRH

We love your input! We want to make contributing to JazzRH as easy and transparent as possible, whether it's:

- Reporting a bug
- Discussing the current state of the code
- Submitting a fix
- Proposing new features
- Becoming a maintainer

## We Develop with GitHub

We use GitHub to host code, to track issues and feature requests, as well as accept pull requests.

## We Use [Git Flow](https://guides.github.com/introduction/flow/index.html)

Pull requests are the best way to propose changes to the codebase. We actively welcome your pull requests:

1. Fork the repo and create your branch from `develop`.
2. If you've added code that should be tested, add tests.
3. Ensure the test suite passes.
4. Make sure your code follows the style guide.
5. Issue that pull request!

## Any Contributions You Make Will Be Under the MIT Software License

In short, when you submit code changes, your submissions are understood to be under the same [MIT License](http://choosealicense.com/licenses/mit/) that covers the project. Feel free to contact the maintainers if that's a concern.

## Report Bugs Using GitHub's [Issues](https://github.com/michelmelo/laravel-jazzrh/issues)

We use GitHub issues to track public bugs. Report a bug by [opening a new issue](https://github.com/michelmelo/laravel-jazzrh/issues/new); it's that easy!

### Write Bug Reports with These Details

**Great Bug Reports** tend to have:

- A quick summary and/or background
- Steps to reproduce
- Be specific!
- Give sample code to an example
- What you expected would happen
- What actually happens
- Notes (possibly including why you think this might be happening, or stuff you tried that didn't work)

## Use a Consistent Coding Style

* PHP-FIG's [PSR-12](https://www.php-fig.org/psr/psr-12/) code standard
* Laravel's [code style guide](https://laravel.com/docs/contributions#code-style)
* Use 4 spaces for indentation rather than tabs
* Use meaningful variable and function names
* Add comments for complex logic

## Testing

```bash
# Run all tests
composer test

# Run specific test
composer test -- tests/Feature/UserControllerTest.php

# Run tests with coverage
composer test -- --coverage
```

## Pull Request Process

1. Update the README.md with details of changes to the interface
2. Update the CHANGELOG.md with notes on your changes
3. Increase the version numbers following [Semantic Versioning](https://semver.org/)
4. Ensure all tests pass
5. Ensure code follows the style guide
6. Request review from maintainers

## Code Style Guidelines

### PHP Code Style

```php
<?php

namespace MichelMelo\JazzRh\Example;

class ExampleClass
{
    // Properties should be typed
    private string $name;
    protected int $value = 0;
    public const MAX_VALUE = 100;

    // Methods should have return types
    public function getName(): string
    {
        return $this->name;
    }

    // Use nullable types when appropriate
    public function setValue(?int $value): void
    {
        $this->value = $value ?? 0;
    }

    // Use short closures when appropriate
    public function process(array $items): array
    {
        return array_map(fn($item) => $item * 2, $items);
    }
}
```

### Docblock Style

```php
/**
 * Get all users with pagination.
 *
 * @param int $perPage Items per page
 * @return \Illuminate\Pagination\Paginator
 */
public function getAllUsers(int $perPage = 15): Paginator
{
    // Implementation
}
```

## Directory Structure

```
packages/jazzrh/
├── src/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   ├── Repositories/
│   ├── Requests/
│   ├── Resources/
│   ├── Traits/
│   ├── Exceptions/
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeders/
│   ├── Config/
│   ├── Providers/
│   └── Facades/
├── routes/
├── tests/
│   ├── Feature/
│   └── Unit/
├── resources/
│   └── lang/
└── docs/
```

## Commit Message Guidelines

```
[TYPE] Brief description (50 chars max)

Detailed explanation if needed (72 chars per line)

- Bullet point 1
- Bullet point 2

Fixes #123
Closes #456
```

Types:
- `feat:` A new feature
- `fix:` A bug fix
- `docs:` Documentation only changes
- `style:` Changes that don't affect code meaning
- `refactor:` Code change that neither fixes a bug nor adds a feature
- `performance:` Code change that improves performance
- `test:` Adding missing tests
- `chore:` Changes to build process, dependencies, etc

## License

By contributing to JazzRH, you agree that your contributions will be licensed under its MIT License.

## Questions or Need Help?

Feel free to open an issue or contact the maintainers at dev@michelmelo.com
