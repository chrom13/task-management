# task-management
Task Management API with Notifications


# Set up
Crete the .env file and copy here the content from .env.example file

Go to the DB_ section and set the values for your database

Go to MAIL_MAILER and set the value to log in order to avoid send notification by email and then log the notifications on storage/logs/laravel.log

Execute these commands:
```
composer install
php artisan migrate
php artisan db:seed 
```

# Sending notifications

If you want to execute the command to send notification; please run:
```
php artisan tasks:check-due-dates
```