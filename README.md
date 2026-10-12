# webservco/symfony-sandbox

A Symfony sandbox project.

Symfony 7.4 experiments in one app: Doctrine CRUD pages, an EasyAdmin dashboard, an API Platform API, registration and login, translations and Tabler layouts.

- Requires: PHP 8.4+, [ddev](https://ddev.com/)
- Includes: Doctrine ORM with migrations, fixtures and Foundry factories, [EasyAdmin](https://symfony.com/bundles/EasyAdminBundle/current/index.html), [API Platform](https://api-platform.com/) 4, Pagerfanta, AssetMapper with Stimulus and Turbo, Mailer with email verification
- Validation: PHP_CodeSniffer, PHPStan, Psalm, Phan, PHPMD and Twig CS Fixer, configured by `webservco/coding-standards`
- Related: `webservco/symfony-project-skeleton` (the minimal project template)

---

## Installation

```shell
git clone git@github.com:webservco/symfony-sandbox.git
cd symfony-sandbox
# Start project.
ddev start
# Install dependencies.
ddev c u
# Create the tables.
ddev sc doctrine:migrations:migrate
# Load 256 addresses and the test users.
ddev sc doctrine:fixtures:load
```

The URL is `https://symfony-sandbox.ddev.site`.

---

## Usage

| Page | Purpose |
| --- | --- |
| `/address/browse` | Paginated address list. |
| `/address/create`, `/address/{id}`, `/address/edit/{id}` | Address form, details and edit page. |
| `/admin` | EasyAdmin dashboard with address CRUD. Needs `ROLE_ADMIN`. |
| `/api` | API Platform documentation. Addresses are at `/api/addresses`, filtered by `name`. |
| `/things`, `/things/{id}` | Pages for hardcoded data, without a database. |
| `/api/things`, `/api/things/{id}` | The same data as JSON, from a plain controller. |
| `/en/i18n`, `/hu/i18n` | Translations in English and Hungarian. |
| `/development/tabler/combo`, `/development/tabler/claudiu` | [Tabler](https://tabler.io/) layout tests. |
| `/register`, `/login`, `/logout` | Registration with email verification, and login by username. |

`ddev sc app:test` runs an example command that shows a progress bar.

### Test users

| Username | Password | Roles |
| --- | --- | --- |
| `admin` | `adminpass` | `ROLE_ADMIN` |
| `superadmin` | `adminpass` | `ROLE_SUPER_ADMIN` |
| `moderatoradmin` | `adminpass` | `ROLE_MODERATOR` |
| `tisha` | `tishapass` | `ROLE_USER` |

---

## Notes

There's no role hierarchy, so only `admin` can open `/admin`.

Read the verification emails with `ddev mailpit`.

`compose.yaml` and `compose.override.yaml` are the Symfony Docker defaults and aren't used with ddev.

There are no tests yet, so `ddev c test` finds nothing to run.

---

## Development

```shell
# Run all validations.
ddev c c
# Fix code style.
ddev c fix:phpcs
ddev c fix:twig
# Run unit tests.
ddev c test:dox
```

---

## License

[MIT](LICENSE.md)
