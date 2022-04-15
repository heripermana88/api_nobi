# Laravel/Lumen api_nobi

Clone this Repo
```
git clone <repo>
```

Setup .env
```
cp .env.example .env
```
implement your detail DB

setup key App
```
sed -i "s|\(APP_KEY=\)\(.*\)|\1$(openssl rand -base64 24)|" .env
```

install dependencies
```
composer install
```

install passport
```
php artisan passport:install
```

run your server
```
php -S localhost:8081 -t public
```
