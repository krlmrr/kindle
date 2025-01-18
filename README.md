# Kindle
## A opinionated Laravel starter kit for building web apps.
### Kindle includes:
- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Livewire / Alpine JS](https://livewire.laravel.com)
- [Pest](https://pestphp.com)
- [Flux UI](https://fluxui.dev) (paid)
- [Laravel Nova](https://nova.laravel.com) (paid)
- [Laravel Reverb / Echo](https://laravel.com/docs/broadcasting)
- [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze)
- [Tighten Duster](https://github.com/tighten/duster) / [Pint Config](https://github.com/tighten/duster/blob/3.x/standards/pint.json)
- [Solo](https://github.com/aarondfrancis/solo) (Thanks Aaron Francis!)
- [Volt](https://livewire.laravel.com/docs/volt)
- [~~Folio~~](https://laravel.com/docs/11.x/folio) I would like to add this back in, but it's adding a little bit of complexity to the project.
- [Telecope](https://laravel.com/docs/11.x/telescope#main-content)
- [Horizon](https://laravel.com/docs/11.x/horizon)
- [Pennant](https://laravel.com/docs/11.x/pennant)
- [Debugbar](https://github.com/barryvdh/laravel-debugbar) / [ide-helper](https://github.com/barryvdh/laravel-ide-helper)
- [Pint](https://laravel.com/docs/11.x/pint#main-content)
- [Pail](https://github.com/laravel/pail)

### How do I use this?
1. Clone this repo
2. Run `composer install`
3. Run `cp .env.example .env`
4. Run `php artisan key:generate`
5. Run `php artisan solo`
6. Profit?

### What features does this include?
- A basic auth setup
- Sensible defaults for your `.env` file (assuming you are using Herd Pro).
- Basic roles and permissions setup.
- Fully embraced Flux UI layout by default! (All auth pages are built with Flux UI).
- Notifications out of the box!
- A theme-switcher.
- Two-factor authentication.
