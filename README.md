## A chat package for Laravel

[![Build Status](https://travis-ci.com/khall212/laravel-chat.svg?branch=master)](https://travis-ci.org/khall212/laravel-chat) [![Coverage Status](https://coveralls.io/repos/github/khall212/laravel-chat/badge.svg?branch=master)](https://coveralls.io/github/khall212/laravel-chat?branch=master)

simple chat package for laravel

### installation


```bash
composer require khall/laravel-chat
```

### how to use it ?

```bash
php artisan vendor:publish --provider="Khall\Chat\ChatServiceProvider" 
```

This command will generate
- **views** vendor/chat 
- **config** file of configuration in config path
- **migrations** in database/migrations folder 
