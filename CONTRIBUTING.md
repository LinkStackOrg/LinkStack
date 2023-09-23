# Contributing to LinkStack

We love your input! We want to make contributing to this project as easy and transparent as possible, whether it's:

- Reporting a bug
- Discussing the current state of the code
- Submitting a fix
- Proposing new features
- Becoming a maintainer

## We use Discord to communicate

This is the fastest way to reach us. Feel free to contact the team for any questions you have.
[Join here]( https://discord.gg/CFZm2qeCVM )

## We Develop with Github

We use github to host code, to track issues and feature requests, as well as accept pull requests.

## We Use [Github Flow](https://guides.github.com/introduction/flow/index.html), So All Code Changes Happen Through Pull Requests

Pull requests are the best way to propose changes to the codebase (we use [Github Flow](https://guides.github.com/introduction/flow/index.html)). We actively welcome your pull requests:

1. Fork the repo and create your branch from `master`.
2. Clone your repository to your local machine.
3. Open a terminal window in that folder.
4. Run these commands:
```
composer update -vvv

php artisan migrate
php artisan db:seed 
php artisan db:seed --class="AdminSeeder"
php artisan db:seed --class="PageSeeder"
php artisan db:seed --class="ButtonSeeder"
```
5. Move the folder into a local web server (make sure you double-check the [requirements](https://linkstack.org/docs/d/installation-requirements/)).
6. Now edit any files you want to change.
7. Commit your changes to your forked repository.
8. Issue that pull request!

### Credentials for your development environment
The default seeded user is `admin@admin.com` with password `12345678` as set in [AdminSeeder.php](database/seeders/AdminSeeder.php)

## Any contributions you make will be under the GPL-3.0 Software License

In short, when you submit code changes, your submissions are understood to be under the same [GPL-3.0](https://choosealicense.com/licenses/gpl-3.0/) that covers the project. Feel free to contact the maintainers if that's a concern.

## Report bugs using Github's [issues](https://github.com/briandk/transcriptase-atom/issues)

We use GitHub issues to track public bugs. Report a bug by [opening a new issue](); it's that easy!

## Write bug reports with detail, background, and sample code

**Great Bug Reports** tend to have:

- A quick summary and/or background
- Steps to reproduce
  - Be specific!
  - Give sample code if you can. [My stackoverflow question](http://stackoverflow.com/q/12488905/180626) includes sample code that *anyone* with a base R setup can run to reproduce what I was seeing
- What you expected would happen
- What actually happens
- Notes (possibly including why you think this might be happening, or stuff you tried that didn't work)

People *love* thorough bug reports. I'm not even kidding.


## License

By contributing, you agree that your contributions will be licensed under its GPL-3.0 License.

