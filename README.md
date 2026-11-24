# Dog-ear Books: a Forms Captcha demo for Statamic

A made-up independent bookshop for trying [Forms Captcha for Statamic](https://github.com/1994limited/forms-captcha-statamic). Every form on the site has a Captcha field, each shown a different way:

| Page | Form | Shows |
| --- | --- | --- |
| `/contact` | Contact the shop | Statamic draws the form with `{{ fields }}`, Captcha field included (`resources/views/contact.antlers.html`). |
| `/ask-a-bookseller` | Ask a bookseller | A hand-written template that places the widget with `{{ forms_captcha }}` (`resources/views/ask_a_bookseller.antlers.html`). |
| Every page's footer | Newsletter | Sent with `fetch()`. Errors come back as JSON, and the widget resets for the next try (`resources/views/partials/footer.antlers.html`). Its widget is Turnstile's full width, to fit the column. |
| `/contact-blade` | Contact the shop, again | A Blade template, with `<s:forms_captcha :fields="$fields" />` (`resources/views/contact_blade.blade.php`). |

The captcha is Cloudflare Turnstile, with Cloudflare's test keys, so it runs without an account anywhere. The red "For testing only" line under each widget is Cloudflare's label for its test keys; it isn't there with real ones.

## Running it

It needs PHP 8.3 or later and Composer.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan demo:users
php artisan serve
```

Sign in at `/cp` as `admin@example.com` with the password `password`. `demo:users` refuses to run unless `APP_ENV=local`, since its password is known.

Until Forms Captcha is on Packagist, `composer.json` installs it from `../forms-captcha-statamic`, so clone [the addon](https://github.com/1994limited/forms-captcha-statamic) next to this folder first.

## Trying it

- **Send a form.** The test keys always pass, so every form goes through. Submissions are under **Forms** in the Control Panel, with no trace of the captcha in them.
- **See one refused.** In `.env`, change `FORMS_CAPTCHA_SECRET_KEY` to Turnstile's always-fail key, `2x0000000000000000000000000000000AA`, then send a form. It's refused with "We couldn't check you're not a robot", and the visitor's answers stay in the form. In the footer's newsletter, the widget resets and you can send again.
- **Change provider.** `.env.example` has the test keys for hCaptcha and reCAPTCHA v2 too. Their test widgets need the box ticking, then always pass.
- **Look at the field.** Open **Forms → Contact the shop** in the Control Panel: the Captcha field is at the end of the form. Click it for its settings (here, the Light theme). Drag another one in from **Structure** on the left.
- **Keep low scores as spam.** That needs reCAPTCHA v3, which has no test keys: set `FORMS_CAPTCHA_DRIVER=recaptcha_v3` with your own keys (with this site's domain added in Google's console), and choose **Keep as spam** in the field's settings.

Multi-page forms need Statamic's Forms Pro, so the demo doesn't have one. [The addon's docs](https://github.com/1994limited/forms-captcha-statamic/blob/main/docs/spam.md#multi-page-forms) explain how the field works on them.

## Licence

The demo's code is [MIT licensed](LICENSE.md), like [Forms Captcha](https://github.com/1994limited/forms-captcha-statamic) itself. The books, covers and journal are made up for Dog-ear Books.
