## _⚙️ Admin littlelink_

Admin littlelink is an admin panel for [littlelink] that provides you a website similar [linktree].

## Features

- creating a link page with more than 20 buttons
- raising important links on the page
- counting clicks
- managing users and pages and links
- and ...

## Demo

[home] / [panel]

## Install

```sh
composer require khashayarzavosh/admin-littlelink
composer update
npm install
npm run dev
```

change .env.example to .env and edit .env file

DB_DATABASE=YOUR_DATABASE_NAME

DB_USERNAME=YOUR_USERNAME

DB_PASSWORD=YOUR_PASSWORD

Rename the website: /config/app.php

'name' => env('APP_NAME', 'Admin Littlelink'),

```sh
php artisan migrate
php artisan db:seed 
(or commands below)
php artisan db:seed --class="AdminSeeder"
php artisan db:seed --class="PageSeeder"
php artisan db:seed --class="ButtonSeeder"
php artisan serve
```

login:

http://127.0.0.1:8000/login

email: admin@admin.com

password: 12345678

## Partner

- [littlelink]
- [laravel]

## [Donate](#donate)

bitcoin: 1FQJWCZJoLKfJei7NFisTH65yNUjugJRi4

   [littlelink]: <https://github.com/sethcottle/littlelink>
   [linktree]: <https://linktr.ee>
   [home]: <https://github.com/khashayarzavosh/admin-littlelink/blob/main/demo-home.png>
   [panel]: <https://github.com/khashayarzavosh/admin-littlelink/blob/main/demo-panel.png>
   [laravel]: <https://github.com/laravel/laravel>
   
