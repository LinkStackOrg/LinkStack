## _⚙️ LittleLink Admin_
Forked from [littlelink-admin]

LittleLink Admin is an admin panel for [littlelink] that provides you a website similar [linktree].

## 📑 Features

- creating a link page with more than 20 buttons
- raising important links on the page
- ordering links (new)
- custom link option (new)
- Social Share Preview for individual users (new)
- counting clicks
- managing users and pages and links
- and ...

## 🔨 Install

```sh
git clone https://github.com/JulianPrieber/littlelink-admin
cd littlelink-admin
cp .env.example .env
composer update -vvv
```

- edit .env file

```sh
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USER
DB_PASSWORD=YOUR_DB_PASS
APP_NAME="YOUR_APP_NAME"
```

- run migration & db seed

```sh
php artisan migrate
php artisan db:seed 
(or commands below)
php artisan db:seed --class="AdminSeeder"
php artisan db:seed --class="PageSeeder"
php artisan db:seed --class="ButtonSeeder"

php artisan key:generate
php artisan serve (optional)
```

- login:

```sh
email: admin@admin.com
password: 12345678
```

## 💞 Partners

- [littlelink]
- [laravel]
- [panel template]

## 🎲 [Donate](#donate)

@khashayarzavosh bitcoin: 1FQJWCZJoLKfJei7NFisTH65yNUjugJRi4

   [littlelink-admin]: <https://github.com/khashayarzavosh/littlelink-admin>
   [littlelink]: <https://github.com/sethcottle/littlelink>
   [linktree]: <https://linktr.ee>
   [laravel]: <https://github.com/laravel/laravel>
   [panel template]: <https://colorlib.com/wp/bootstrap-sidebar>
